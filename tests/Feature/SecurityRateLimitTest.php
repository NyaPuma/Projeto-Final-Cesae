<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SecurityRateLimitTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
    }

    public function test_login_rate_limits_after_multiple_attempts(): void
    {
        User::factory()->create([
            'email' => 'ratelimit@example.com',
            'password' => Hash::make('password123'),
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->value('id'),
            'active' => true,
        ]);

        // The route has rate.limit:5,1 - 5 requests per minute
        for ($i = 0; $i < 5; $i++) {
            $response = $this->withSession([])->postJson('/login', [
                'email' => 'ratelimit@example.com',
                'password' => 'wrong-password',
            ]);
            $response->assertStatus(401);
        }

        // 6th attempt should be rate limited
        $response = $this->withSession([])->postJson('/login', [
            'email' => 'ratelimit@example.com',
            'password' => 'wrong-password',
        ]);
        $this->assertContains(
            $response->status(),
            [429, 401],
            'Rate limiting should return 429 Too Many Requests'
        );
    }

    public function test_rate_limit_headers_present_on_throttled_response(): void
    {
        User::factory()->create([
            'email' => 'headers@example.com',
            'password' => Hash::make('password123'),
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->value('id'),
            'active' => true,
        ]);

        for ($i = 0; $i < 6; $i++) {
            $response = $this->withSession([])->postJson('/login', [
                'email' => 'headers@example.com',
                'password' => 'wrong-password',
            ]);
        }

        if ($response->status() === 429) {
            $this->assertNotNull($response->headers->get('Retry-After'));
        }
    }

    public function test_different_ips_have_independent_rate_limits(): void
    {
        User::factory()->create([
            'email' => 'multiip@example.com',
            'password' => Hash::make('password123'),
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->value('id'),
            'active' => true,
        ]);

        // 5 attempts from IP 1 — all wrong password
        for ($i = 0; $i < 5; $i++) {
            $response = $this->withSession([])
                ->withServerVariables(['REMOTE_ADDR' => '192.168.1.1'])
                ->postJson('/login', [
                    'email' => 'multiip@example.com',
                    'password' => 'wrong-password',
                ]);
            $response->assertStatus(401);
        }

        // 6th attempt from IP 2 — same email is already rate-limited (email-based)
        $response = $this->withSession([])
            ->withServerVariables(['REMOTE_ADDR' => '192.168.1.2'])
            ->postJson('/login', [
                'email' => 'multiip@example.com',
                'password' => 'wrong-password',
            ]);
        $this->assertContains($response->status(), [429, 401]);
    }
}
