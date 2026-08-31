<?php

namespace Tests\Feature;

use App\Enums\UserRoleEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\TicketStatusService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class TicketAuthorizationFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);
        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);
    }

    private function createUserWithToken(string $profileName): User
    {
        $profile = UserProfile::where('name', $profileName)->firstOrFail();

        return User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);
    }

    private function createTicketFor(User $owner, array $overrides = []): Ticket
    {
        $openId = app(TicketStatusService::class)->getByName(TicketStatusEnum::Open);

        return Ticket::create(array_merge([
            'user_id' => $owner->id,
            'title' => 'Ticket de '.$owner->name,
            'description' => 'Descrição do ticket.',
            'priority' => TicketPriorityEnum::Medium->value,
            'status_id' => $openId,
            'opened_at' => now(),
        ], $overrides));
    }

    public function test_common_user_index_lists_only_own_tickets(): void
    {
        $common = $this->createUserWithToken(UserRoleEnum::User->value);
        $other = $this->createUserWithToken(UserRoleEnum::User->value);

        $own = $this->createTicketFor($common);
        $this->createTicketFor($other);

        $response = $this->withHeader('X-Auth-Token', $common->api_token)
            ->getJson('/api/tickets');

        $response->assertOk();
        $ids = collect($response->json('tickets'))->pluck('id')->all();
        $this->assertContains($own->id, $ids);
        $this->assertNotContains($other->id, $ids);
    }

    public function test_technician_index_lists_assigned_tickets(): void
    {
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $common = $this->createUserWithToken(UserRoleEnum::User->value);

        $own = $this->createTicketFor($common, ['assigned_to' => $technician->id]);
        $other = $this->createTicketFor($this->createUserWithToken(UserRoleEnum::User->value), ['assigned_to' => $technician->id]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/api/tickets');

        $response->assertOk();
        $ids = collect($response->json('tickets'))->pluck('id')->all();
        $this->assertContains($own->id, $ids);
        $this->assertContains($other->id, $ids);
    }

    public function test_common_user_search_only_returns_own_tickets(): void
    {
        $common = $this->createUserWithToken(UserRoleEnum::User->value);
        $other = $this->createUserWithToken(UserRoleEnum::User->value);

        $own = $this->createTicketFor($common, ['title' => 'Motor compressor aquece']);
        $otherTicket = $this->createTicketFor($other, ['title' => 'Motor compressor aquece igual']);

        $response = $this->withHeader('X-Auth-Token', $common->api_token)
            ->getJson('/api/tickets/search?q=compressor');

        $response->assertOk();
        $ids = collect($response->json('tickets'))->pluck('id')->all();
        $this->assertContains($own->id, $ids);
        $this->assertNotContains($otherTicket->id, $ids);
    }

    public function test_search_filters_by_equipment(): void
    {
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $room = Room::create(['name' => 'Lab A', 'location' => 'Floor 1', 'active' => true]);
        $equipmentA = Equipment::create(['name' => 'Impressora A', 'serial' => 'A-001', 'room_id' => $room->id, 'active' => true]);
        $equipmentB = Equipment::create(['name' => 'Impressora B', 'serial' => 'B-001', 'room_id' => $room->id, 'active' => true]);

        $ticketA = $this->createTicketFor($this->createUserWithToken(UserRoleEnum::User->value), [
            'equipment_id' => $equipmentA->id,
            'title' => 'Problema na impressora A',
            'assigned_to' => $technician->id,
        ]);
        $this->createTicketFor($this->createUserWithToken(UserRoleEnum::User->value), [
            'equipment_id' => $equipmentB->id,
            'title' => 'Problema na impressora B',
            'assigned_to' => $technician->id,
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/api/tickets/search?equipment_id='.$equipmentA->id);

        $response->assertOk();
        $ids = collect($response->json('tickets'))->pluck('id')->all();
        $this->assertContains($ticketA->id, $ids);
        $this->assertCount(1, $ids);
    }

    public function test_common_user_cannot_access_most_urgent_ticket(): void
    {
        $common = $this->createUserWithToken(UserRoleEnum::User->value);

        $response = $this->withHeader('X-Auth-Token', $common->api_token)
            ->getJson('/tickets/most-urgent');

        $response->assertStatus(403);
    }

    public function test_technician_can_access_most_urgent_ticket(): void
    {
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $this->createTicketFor($this->createUserWithToken(UserRoleEnum::User->value), [
            'priority' => TicketPriorityEnum::Critical->value,
        ]);

        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->getJson('/tickets/most-urgent');

        $response->assertOk()
            ->assertJsonStructure(['ticket_id', 'title', 'priority']);
    }
}
