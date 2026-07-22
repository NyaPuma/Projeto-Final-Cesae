<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SecurityVulnerabilitiesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class' => 'TicketLookupSeeder', '--force' => true]);
    }

    public function test_sql_injection_attempt_in_search_query_is_safely_escaped()
    {
        $adminProfile = UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        $user = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);
        Ticket::factory()->create(['title' => 'Bomba 1']);

        $maliciousQuery = "' OR '1'='1";

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->actingAs($user)
            ->getJson("/api/admin/users?q=" . urlencode($maliciousQuery));

        $response->assertStatus(200);
        // Ensure query didn't dump all users or crash database
        $this->assertCount(0, $response->json('users.data'));
    }

    public function test_xss_payload_in_ticket_description_does_not_execute_raw_script()
    {
        $userProfile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        $operator = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
        ]);

        $xssPayload = "<script>alert('XSS')</script>Avaria no motor";

        $response = $this->withHeader('X-Auth-Token', $operator->api_token)
            ->actingAs($operator)
            ->postJson('/api/tickets', [
                'title' => 'Avaria XSS Test',
                'description' => $xssPayload,
                'priority' => 'média',
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('tickets', [
            'title' => 'Avaria XSS Test',
        ]);
    }

    public function test_broken_access_control_operator_cannot_create_users()
    {
        $userProfile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        $operator = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
        ]);

        // Operator attempts to create a new user via admin endpoint
        $response = $this->withHeader('X-Auth-Token', $operator->api_token)
            ->actingAs($operator)
            ->postJson('/api/admin/users', [
                'name' => 'Hacker Account',
                'email' => 'hacker@empresa.pt',
                'password' => 'password123',
                'profile_id' => $userProfile->id,
            ]);

        $response->assertStatus(403);
    }
}
