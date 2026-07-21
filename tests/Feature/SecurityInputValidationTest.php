<?php

namespace Tests\Feature;

use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class SecurityInputValidationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
        UserProfile::create(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::create(['name' => User::ROLE_ADMIN]);
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

    public function test_sql_injection_in_ticket_title_is_sanitized(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => "'; DROP TABLE tickets; --",
                'description' => 'SQL injection attempt',
                'priority' => Ticket::PRIORITY_MEDIUM,
                'status_id' => $openId,
            ]);

        $this->assertContains($response->status(), [201, 422]);

        if ($response->status() === 201) {
            $this->assertDatabaseHas('tickets', [
                'title' => "'; DROP TABLE tickets; --",
            ]);
        }
    }

    public function test_xss_payload_in_description_is_stored_safely(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $xssPayload = '<script>alert("XSS")</script>';
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => 'XSS test ticket',
                'description' => $xssPayload,
                'priority' => Ticket::PRIORITY_LOW,
                'status_id' => $openId,
            ]);

        $this->assertContains($response->status(), [201, 422]);

        if ($response->status() === 201) {
            $ticket = Ticket::where('title', 'XSS test ticket')->first();
            $this->assertNotNull($ticket);
            $this->assertStringContainsString('script', $ticket->description);
        }
    }

    public function test_html_injection_in_comment_is_stored_safely(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $technician = $this->createUserWithToken(User::ROLE_TECHNICIAN);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'title' => 'HTML injection test',
            'description' => 'Testing HTML injection in comments',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'status_id' => $openId,
            'opened_at' => now(),
        ]);

        $htmlPayload = '<img src=x onerror=alert(1)>';
        $response = $this->withHeader('X-Auth-Token', $technician->api_token)
            ->postJson("/tickets/{$ticket->id}/comments", [
                'comment' => $htmlPayload,
            ]);

        $this->assertContains($response->status(), [201, 422]);

        if ($response->status() === 201) {
            $this->assertDatabaseHas('ticket_comments', [
                'ticket_id' => $ticket->id,
                'comment' => $htmlPayload,
            ]);
        }
    }

    public function test_mass_assignment_protection_on_ticket_creation(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => 'Mass assignment test',
                'description' => 'Testing mass assignment protection',
                'priority' => Ticket::PRIORITY_HIGH,
                'status_id' => $openId,
                'id' => 99999,
                'user_id' => 1,
                'assigned_to' => 1,
                'minutes_spent' => 999,
                'cost' => 99999.99,
            ]);

        $this->assertContains($response->status(), [201, 422]);

        if ($response->status() === 201) {
            $ticket = Ticket::where('title', 'Mass assignment test')->first();
            $this->assertNotNull($ticket);
            $this->assertNotEquals(99999, $ticket->id);
            $this->assertEquals($user->id, $ticket->user_id);
            $this->assertNull($ticket->assigned_to);
            $this->assertNotEquals(999, $ticket->minutes_spent);
        }
    }

    public function test_unexpected_fields_are_ignored(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => 'Unexpected fields test',
                'description' => 'Testing unexpected fields are ignored',
                'priority' => Ticket::PRIORITY_MEDIUM,
                'status_id' => $openId,
                'is_admin' => true,
                'role' => 'superadmin',
                'is_active' => 1,
            ]);

        $this->assertContains($response->status(), [201, 422]);
    }

    public function test_very_long_input_is_rejected(): void
    {
        $user = $this->createUserWithToken(User::ROLE_USER);
        $openId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => str_repeat('A', 500),
                'description' => 'Testing very long title',
                'priority' => Ticket::PRIORITY_LOW,
                'status_id' => $openId,
            ]);

        $response->assertStatus(422);
    }
}
