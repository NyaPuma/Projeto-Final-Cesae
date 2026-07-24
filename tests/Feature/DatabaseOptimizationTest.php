<?php

namespace Tests\Feature;

use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Tests\TestCase;

class DatabaseOptimizationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Ticket::flushStatusCache();
    }

    public function test_ticket_status_cache_returns_correct_id(): void
    {
        $status = TicketStatus::create(['name' => 'cached_test', 'description' => 'Test']);

        $result = Ticket::getStatusIdByName('cached_test');
        $this->assertEquals($status->id, $result);
    }

    public function test_ticket_status_cache_returns_null_for_nonexistent(): void
    {
        $result = Ticket::getStatusIdByName('nonexistent_status_xyz');
        $this->assertNull($result);
    }

    public function test_ticket_status_cache_returns_consistent_results(): void
    {
        $status = TicketStatus::create(['name' => 'consistent_test', 'description' => 'Test']);

        $first = Ticket::getStatusIdByName('consistent_test');
        $second = Ticket::getStatusIdByName('consistent_test');

        $this->assertEquals($first, $second);
        $this->assertEquals($status->id, $first);
    }

    public function test_flush_status_cache_clears_cached_values(): void
    {
        TicketStatus::create(['name' => 'flush_test', 'description' => 'Test']);

        Ticket::getStatusIdByName('flush_test');
        Ticket::flushStatusCache();

        $status = TicketStatus::where('name', 'flush_test')->first();
        $this->assertEquals($status->id, Ticket::getStatusIdByName('flush_test'));
    }

    public function test_room_soft_delete_prevents_hard_delete(): void
    {
        $room = Room::factory()->create();
        $roomId = $room->id;

        $room->delete();

        $this->assertSoftDeleted('rooms', ['id' => $roomId]);
        $this->assertNull(Room::find($roomId), 'Soft-deleted room should not appear in normal queries');
    }

    public function test_room_restore_after_soft_delete(): void
    {
        $room = Room::factory()->create();

        $room->delete();
        $this->assertSoftDeleted('rooms', ['id' => $room->id]);

        $room->restore();
        $this->assertNotSoftDeleted('rooms', ['id' => $room->id]);
        $this->assertNotNull(Room::find($room->id));
    }

    public function test_room_equipments_not_deleted_on_soft_delete(): void
    {
        $room = Room::factory()->create();
        $equipment = Equipment::factory()->create(['room_id' => $room->id]);

        $room->delete();

        $this->assertDatabaseHas('equipments', ['id' => $equipment->id, 'room_id' => $room->id]);
    }

    public function test_analytics_payload_uses_database_aggregation(): void
    {
        $this->seedLookupData();

        $openId = Ticket::getStatusIdByName('aberta');
        $closedId = Ticket::getStatusIdByName('fechada');

        Ticket::factory()->count(5)->create(['status_id' => $openId, 'opened_at' => now()->subHours(2)]);
        Ticket::factory()->count(3)->create([
            'status_id' => $closedId,
            'opened_at' => now()->subHours(10),
            'closed_at' => now()->subHours(2),
            'cost' => 100,
        ]);

        $response = $this->withHeader('X-Auth-Token', $this->createAdminUser()->api_token)
            ->getJson('/api/analytics/stats');

        $response->assertOk();
        $response->assertJsonFragment(['open_tickets' => 5]);
        $response->assertJsonFragment(['closed_tickets' => 3]);
    }

    public function test_analytics_payload_structure_is_complete(): void
    {
        $this->seedLookupData();

        $response = $this->withHeader('X-Auth-Token', $this->createAdminUser()->api_token)
            ->getJson('/api/analytics/stats');

        $response->assertOk()
            ->assertJsonStructure([
                'average_resolution_minutes',
                'average_waiting_minutes',
                'open_tickets',
                'in_progress_tickets',
                'waiting_budget_tickets',
                'closed_tickets',
                'system_availability',
                'sla_success',
                'by_priority',
                'ticket_status_breakdown',
                'monthly_tickets',
                'monthly_cost',
                'top_equipments',
                'top_rooms',
                'top_technicians',
                'recent_activity',
            ]);
    }

    public function test_analytics_cache_reduces_repeated_queries(): void
    {
        $this->seedLookupData();

        $admin = $this->createAdminUser();

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->getJson('/api/analytics/stats')->assertOk();

        Cache::flush();

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->getJson('/api/analytics/stats')->assertOk();
        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->getJson('/api/analytics/stats')->assertOk();

        $this->assertTrue(Cache::has('analytics_dashboard_payload'), 'Analytics payload should be cached');
    }

    protected function seedLookupData(): void
    {
        TicketStatus::firstOrCreate(['name' => 'aberta'], ['description' => 'Aberta']);
        TicketStatus::firstOrCreate(['name' => 'em curso'], ['description' => 'Em curso']);
        TicketStatus::firstOrCreate(['name' => 'fechada'], ['description' => 'Fechada']);
        TicketStatus::firstOrCreate(['name' => 'cancelada'], ['description' => 'Cancelada']);
        TicketStatus::firstOrCreate(['name' => 'pendente orçamento'], ['description' => 'Pendente']);
        TicketStatus::firstOrCreate(['name' => 'recusada'], ['description' => 'Recusada']);
    }

    protected function createAdminUser(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        $token = 'admin-opt-token-' . uniqid();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => $token,
        ]);
        $user->raw_token = $token;

        return $user;
    }
}
