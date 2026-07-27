<?php

namespace Tests\Feature;

use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class AnalyticsFeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);
    }

    public function test_operator_is_forbidden_from_analytics_endpoints()
    {
        $userProfile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        $operator = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
        ]);

        $this->withHeader('X-Auth-Token', $operator->api_token)
            ->actingAs($operator)
            ->getJson('/api/analytics/stats')
            ->assertStatus(403);

        $this->withHeader('X-Auth-Token', $operator->api_token)
            ->actingAs($operator)
            ->getJson('/api/analytics/charts')
            ->assertStatus(403);
    }

    public function test_technician_and_admin_can_access_analytics_stats_and_charts()
    {
        $statusOpen = TicketStatus::where('name', 'aberta')->first();
        $statusClosed = TicketStatus::where('name', 'fechada')->first();

        Ticket::factory()->create([
            'status_id' => $statusOpen->id,
            'opened_at' => now()->subHours(2),
        ]);

        Ticket::factory()->create([
            'status_id' => $statusClosed->id,
            'opened_at' => now()->subHours(5),
            'closed_at' => now()->subHours(1),
            'cost' => 150.00,
        ]);

        $adminProfile = UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->getJson('/api/analytics/stats');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'average_resolution_minutes',
                'average_waiting_minutes',
                'open_tickets',
                'closed_tickets',
                'system_availability',
                'sla_success',
                'by_priority',
                'ticket_status_breakdown',
            ]);
    }

    public function test_export_csv_streams_tickets_report()
    {
        $adminProfile = UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);
        Ticket::factory()->create();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->get('/api/analytics/export/csv');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'text/csv; charset=UTF-8');
    }
}
