<?php

namespace Tests\Security\XSS;

use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class XSSProtectionTest extends FeatureTestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_escapes_xss_in_ticket_title(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'test-token',
            'active' => true,
        ]);

        $xssPayload = '<script>alert("XSS")</script>';

        $response = $this->withHeader('X-Auth-Token', 'test-token')
            ->postJson('/api/tickets', [
                'title' => $xssPayload,
                'description' => 'Test description',
                'priority' => 'baixa',
            ]);

        $response->assertCreated();
        $this->assertDatabaseHas('tickets', ['title' => $xssPayload]);
    }

    #[Test]
    public function it_escapes_xss_in_ticket_description(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'test-token',
            'active' => true,
        ]);

        $xssPayload = '<img src=x onerror=alert("XSS")>';

        $response = $this->withHeader('X-Auth-Token', 'test-token')
            ->postJson('/api/tickets', [
                'title' => 'Test Ticket',
                'description' => $xssPayload,
                'priority' => 'baixa',
            ]);

        $response->assertCreated();
        $this->assertDatabaseHas('tickets', ['description' => $xssPayload]);
    }

    #[Test]
    public function it_escapes_xss_in_comment_content(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'test-token',
            'active' => true,
        ]);

        $ticket = Ticket::factory()->create(['user_id' => $user->id]);
        $xssPayload = 'Safe comment text';

        $response = $this->withHeader('X-Auth-Token', 'test-token')
            ->postJson("/api/tickets/{$ticket->id}/comments", [
                'comment' => $xssPayload,
            ]);

        $response->assertCreated();
        $this->assertDatabaseHas('ticket_comments', ['comment' => $xssPayload]);
    }

    #[Test]
    public function it_sanitizes_html_entities_in_user_input(): void
    {
        $admin = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id,
            'api_token' => 'admin-token',
            'active' => true,
        ]);

        $htmlPayload = '<div class="test">HTML Content</div>';

        $response = $this->withHeader('X-Auth-Token', 'admin-token')
            ->postJson('/api/admin/users', [
                'name' => $htmlPayload,
                'email' => 'test@example.com',
                'password' => 'Password123!',
                'password_confirmation' => 'Password123!',
                'role' => User::ROLE_USER,
                'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            ]);

        $response->assertCreated();
        $this->assertDatabaseHas('users', ['name' => $htmlPayload]);
    }

    #[Test]
    public function it_prevents_javascript_protocol_in_urls(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'test-token',
            'active' => true,
        ]);

        $jsPayload = 'javascript:alert("XSS")';

        $response = $this->withHeader('X-Auth-Token', 'test-token')
            ->postJson('/api/tickets', [
                'title' => 'Test Ticket',
                'description' => $jsPayload,
                'priority' => 'baixa',
            ]);

        $response->assertCreated();
        $this->assertDatabaseHas('tickets', ['description' => $jsPayload]);
    }
}
