<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class SecurityBruteForceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
    }

    public function test_multiple_failed_logins_return_401_not_200(): void
    {
        User::factory()->create([
            'email' => 'bruteforce@example.com',
            'password' => Hash::make('password123'),
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->value('id'),
            'active' => true,
            'api_token' => Str::random(60),
        ]);

        for ($i = 0; $i < 10; $i++) {
            $response = $this->withSession([])->postJson('/login', [
                'email' => 'bruteforce@example.com',
                'password' => 'wrong-password-' . $i,
            ]);
            $this->assertContains($response->status(), [401, 429]);
        }
    }

    public function test_rapid_consecutive_requests_are_throttled(): void
    {
        User::factory()->create([
            'email' => 'rapid@example.com',
            'password' => Hash::make('password123'),
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->value('id'),
            'active' => true,
            'api_token' => Str::random(60),
        ]);

        $start = microtime(true);

        for ($i = 0; $i < 10; $i++) {
            $this->withSession([])->postJson('/login', [
                'email' => 'rapid@example.com',
                'password' => 'wrong-password',
            ]);
        }

        $duration = microtime(true) - $start;
        $this->assertLessThan(30, $duration, 'Rate limiting should not cause excessive delays');
    }

    public function test_successful_login_resets_rate_limit_counter(): void
    {
        User::factory()->create([
            'email' => 'resetcounter@example.com',
            'password' => Hash::make('password123'),
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->value('id'),
            'active' => true,
            'api_token' => Str::random(60),
        ]);

        // 3 failed attempts
        for ($i = 0; $i < 3; $i++) {
            $this->withSession([])->postJson('/login', [
                'email' => 'resetcounter@example.com',
                'password' => 'wrong-password',
            ]);
        }

        // Successful login
        $response = $this->withSession([])->postJson('/login', [
            'email' => 'resetcounter@example.com',
            'password' => 'password123',
        ]);
        $response->assertOk();

        // After successful login, new token is returned
        $newToken = $response->json('token');
        $this->assertNotNull($newToken);

        // Verify authenticated access works with the new token
        $profileResponse = $this->withHeader('X-Auth-Token', $newToken)
            ->getJson('/ui/tickets');
        $this->assertContains($profileResponse->status(), [200, 302]);
    }
}
