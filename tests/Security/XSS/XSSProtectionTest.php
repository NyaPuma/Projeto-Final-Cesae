<?php

namespace Tests\Security\XSS;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\ApiTestCase;

class XSSProtectionTest extends ApiTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
    }

    #[Test]
    public function it_escapes_xss_in_ticket_title(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'test-token',
            'active' => true,
        ]);

        $xssPayload = '<script>alert("XSS")</script>';

        $response = $this->withApiUser('test-token')
            ->postJson('/api/tickets', [
                'title' => $xssPayload,
                'description' => 'Test description',
                'priority' => 'baixa',
            ]);

        $response->assertCreated();
        $this->assertStringNotContainsString('<script>', $response->json('ticket.title'));
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

        $response = $this->withApiUser('test-token')
            ->postJson('/api/tickets', [
                'title' => 'Test Ticket',
                'description' => $xssPayload,
                'priority' => 'baixa',
            ]);

        $response->assertCreated();
        $this->assertStringNotContainsString('<img', $response->json('ticket.description'));
    }

    #[Test]
    public function it_escapes_xss_in_comment_content(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'test-token',
            'active' => true,
        ]);

        $ticket = \App\Models\Ticket::factory()->create(['user_id' => $user->id]);
        $xssPayload = '<script>document.location="http://evil.com"</script>';

        $response = $this->withApiUser('test-token')
            ->postJson("/tickets/{$ticket->id}/comments", [
                'comment' => $xssPayload,
            ]);

        $response->assertCreated();
        $this->assertStringNotContainsString('<script>', $response->json('comment.content'));
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

        $response = $this->withApiUser('admin-token')
            ->postJson('/api/admin/users', [
                'name' => $htmlPayload,
                'email' => 'test@example.com',
                'password' => 'Password123!',
                'password_confirmation' => 'Password123!',
                'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            ]);

        $response->assertCreated();
        $this->assertStringNotContainsString('<div', $response->json('user.name'));
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

        $response = $this->withApiUser('test-token')
            ->postJson('/api/tickets', [
                'title' => 'Test Ticket',
                'description' => $jsPayload,
                'priority' => 'baixa',
            ]);

        $response->assertCreated();
        $this->assertStringNotContainsString('javascript:', $response->json('ticket.description'));
    }
}
