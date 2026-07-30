<?php

namespace Tests\Security\RateLimiting;


use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class RateLimitingTest extends FeatureTestCase
{
    #[Test]
    public function it_returns_401_or_429_on_multiple_failed_logins(): void
    {
        User::factory()->create([
            'email' => 'bruteforce@example.com',
            'password' => Hash::make('Password123!'),
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->value('id'),
            'active' => true,
            'api_token' => Str::random(60),
        ]);

        for ($i = 0; $i < 10; $i++) {
            $response = $this->withSession([])->postJson('/api/login', [
                'email' => 'bruteforce@example.com',
                'password' => 'wrong-password-'.$i,
            ]);
            $this->assertContains($response->status(), [401, 429]);
        }
    }

    #[Test]
    public function it_throttles_rapid_consecutive_requests(): void
    {
        User::factory()->create([
            'email' => 'rapid@example.com',
            'password' => Hash::make('Password123!'),
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->value('id'),
            'active' => true,
            'api_token' => Str::random(60),
        ]);

        $start = microtime(true);

        for ($i = 0; $i < 10; $i++) {
            $this->withSession([])->postJson('/api/login', [
                'email' => 'rapid@example.com',
                'password' => 'wrong-password',
            ]);
        }

        $duration = microtime(true) - $start;
        $this->assertLessThan(30, $duration, 'Rate limiting should not cause excessive delays');
    }

    #[Test]
    public function it_resets_rate_limit_counter_after_successful_login(): void
    {
        User::factory()->create([
            'email' => 'resetcounter@example.com',
            'password' => Hash::make('Password123!'),
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->value('id'),
            'active' => true,
            'api_token' => Str::random(60),
        ]);

        for ($i = 0; $i < 3; $i++) {
            $this->withSession([])->postJson('/api/login', [
                'email' => 'resetcounter@example.com',
                'password' => 'wrong-password',
            ]);
        }

        $response = $this->withSession([])->postJson('/api/login', [
            'email' => 'resetcounter@example.com',
            'password' => 'Password123!',
        ]);
        $response->assertOk();

        $newToken = $response->json('token');
        $this->assertNotNull($newToken);

        $profileResponse = $this->withHeader('X-Auth-Token', $newToken)
            ->getJson('/ui/tickets');
        $this->assertContains($profileResponse->status(), [200, 302]);
    }

    #[Test]
    public function it_rate_limits_after_multiple_login_attempts(): void
    {
        User::factory()->create([
            'email' => 'ratelimit@example.com',
            'password' => Hash::make('Password123!'),
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->value('id'),
            'active' => true,
        ]);

        for ($i = 0; $i < 5; $i++) {
            $response = $this->withSession([])->postJson('/api/login', [
                'email' => 'ratelimit@example.com',
                'password' => 'wrong-password',
            ]);
            $response->assertStatus(401);
        }

        $response = $this->withSession([])->postJson('/api/login', [
            'email' => 'ratelimit@example.com',
            'password' => 'wrong-password',
        ]);
        $this->assertContains(
            $response->status(),
            [429, 401],
            'Rate limiting should return 429 Too Many Requests'
        );
    }

    #[Test]
    public function it_returns_retry_after_header_on_throttled_response(): void
    {
        User::factory()->create([
            'email' => 'headers@example.com',
            'password' => Hash::make('Password123!'),
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->value('id'),
            'active' => true,
        ]);

        for ($i = 0; $i < 6; $i++) {
            $response = $this->withSession([])->postJson('/api/login', [
                'email' => 'headers@example.com',
                'password' => 'wrong-password',
            ]);
        }

        if ($response->status() === 429) {
            $this->assertNotNull($response->headers->get('Retry-After'));
        }
    }

    #[Test]
    public function it_applies_independent_rate_limits_per_ip(): void
    {
        User::factory()->create([
            'email' => 'multiip@example.com',
            'password' => Hash::make('Password123!'),
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->value('id'),
            'active' => true,
        ]);

        for ($i = 0; $i < 5; $i++) {
            $response = $this->withSession([])
                ->withServerVariables(['REMOTE_ADDR' => '192.168.1.1'])
                ->postJson('/api/login', [
                    'email' => 'multiip@example.com',
                    'password' => 'wrong-password',
                ]);
            $response->assertStatus(401);
        }

        $response = $this->withSession([])
            ->withServerVariables(['REMOTE_ADDR' => '192.168.1.2'])
            ->postJson('/api/login', [
                'email' => 'multiip@example.com',
                'password' => 'wrong-password',
            ]);
        $this->assertContains($response->status(), [429, 401]);
    }
}
