<?php

namespace Tests\Feature\Middleware;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RateLimitMiddlewareTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();
        UserProfile::create(['name' => UserRoleEnum::User->value]);

        Route::middleware(['rate.limit:3,1'])->get('/test-rate-limit', function () {
            return response()->json(['ok' => true], 200);
        });
    }

    public function test_blocks_requests_after_max_attempts(): void
    {
        for ($i = 0; $i < 3; $i++) {
            $response = $this->getJson('/test-rate-limit');
            $response->assertStatus(200);
        }

        $response = $this->getJson('/test-rate-limit');

        $response->assertStatus(429);
        $response->assertJsonStructure(['message', 'retry_after']);
        $this->assertNotNull($response->headers->get('Retry-After'));
        $this->assertSame(3, (int) $response->headers->get('X-RateLimit-Limit'));
        $this->assertSame(0, (int) $response->headers->get('X-RateLimit-Remaining'));
    }

    public function test_adds_ratelimit_headers_to_successful_responses(): void
    {
        $response = $this->getJson('/test-rate-limit');

        $response->assertStatus(200);
        $this->assertSame(3, (int) $response->headers->get('X-RateLimit-Limit'));
        $this->assertSame(2, (int) $response->headers->get('X-RateLimit-Remaining'));
    }

    public function test_keys_auth_endpoints_by_ip_and_email(): void
    {
        $user = User::factory()->create([
            'email' => 'rate@example.com',
            'password' => Hash::make('Password123!'),
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->value('id'),
            'active' => true,
        ]);

        for ($i = 0; $i < 5; $i++) {
            $response = $this->withSession([])
                ->withServerVariables(['REMOTE_ADDR' => '192.168.1.1'])
                ->postJson('/api/login', [
                    'email' => 'rate@example.com',
                    'password' => 'wrong-password',
                ]);
            $response->assertStatus(401);
        }

        $blocked = $this->withSession([])
            ->withServerVariables(['REMOTE_ADDR' => '192.168.1.1'])
            ->postJson('/api/login', [
                'email' => 'rate@example.com',
                'password' => 'wrong-password',
            ]);
        $this->assertSame(429, $blocked->status());

        $other = $this->withSession([])
            ->withServerVariables(['REMOTE_ADDR' => '192.168.1.1'])
            ->postJson('/api/login', [
                'email' => 'other@example.com',
                'password' => 'wrong-password',
            ]);
        $other->assertStatus(401);
    }

    public function test_uses_guest_key_for_non_auth_endpoints_when_unauthenticated(): void
    {
        $response = $this->getJson('/test-rate-limit');

        $response->assertStatus(200);
        $this->assertSame(2, (int) $response->headers->get('X-RateLimit-Remaining'));
    }
}
