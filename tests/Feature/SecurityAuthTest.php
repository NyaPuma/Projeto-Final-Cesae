<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Userprofile as UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SecurityAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
        UserProfile::create(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::create(['name' => User::ROLE_ADMIN]);
    }

    private function createProtectedRoute(): void
    {
        Route::middleware(['custom.auth'])->get('/api/test-security', function () {
            return response()->json(['message' => 'secure']);
        });
    }

    #[Test]
    public function empty_token_is_rejected(): void
    {
        $this->createProtectedRoute();

        $response = $this->withHeader('X-Auth-Token', '')
            ->getJson('/api/test-security');

        $response->assertStatus(401);
    }

    #[Test]
    public function malformed_token_is_rejected(): void
    {
        $this->createProtectedRoute();

        $malformedTokens = [
            'not-a-real-token',
            'AAAA',
            str_repeat('A', 60),
            '000000000000000000000000000000000000000000000000000000000000',
            'special!@#$%^&*()chars',
            '<script>alert(1)</script>',
            '../../etc/passwd',
        ];

        foreach ($malformedTokens as $token) {
            $response = $this->withHeader('X-Auth-Token', $token)
                ->getJson('/api/test-security');

            $response->assertStatus(401);
        }
    }

    #[Test]
    public function missing_header_returns_401(): void
    {
        $this->createProtectedRoute();

        $response = $this->getJson('/api/test-security');

        $response->assertStatus(401);
    }

    #[Test]
    public function wrong_header_name_returns_401(): void
    {
        $this->createProtectedRoute();

        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token-Wrong', $user->api_token)
            ->getJson('/api/test-security');

        $response->assertStatus(401);
    }

    #[Test]
    public function token_not_visible_in_json_response(): void
    {
        Route::middleware(['custom.auth'])->get('/api/test-user-json', function () {
            return response()->json(['user' => auth()->user()]);
        });

        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/test-user-json');

        $response->assertOk();
        $response->assertJsonMissing(['api_token' => $user->api_token]);
    }

    #[Test]
    public function token_is_60_characters(): void
    {
        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $this->assertEquals(60, strlen($user->api_token));
    }

    #[Test]
    public function token_is_unique_per_user(): void
    {
        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user1 = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);
        $user2 = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $this->assertNotEquals($user1->api_token, $user2->api_token);
    }

    #[Test]
    public function login_invalidates_previous_token(): void
    {
        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'password' => Hash::make('secret123'),
            'active' => true,
        ]);

        $oldToken = $user->api_token;
        $this->assertNotEmpty($oldToken);

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret123',
        ]);

        $this->createProtectedRoute();

        $response = $this->withHeader('X-Auth-Token', $oldToken)
            ->getJson('/api/test-security');

        $response->assertStatus(401);
    }

    #[Test]
    public function logout_invalidates_token(): void
    {
        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/logout');

        $this->createProtectedRoute();

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/test-security');

        $response->assertStatus(401);
    }

    #[Test]
    public function repeated_authentication_attempts_with_invalid_token(): void
    {
        $this->createProtectedRoute();

        for ($i = 0; $i < 10; $i++) {
            $response = $this->withHeader('X-Auth-Token', 'invalid-token-'.$i)
                ->getJson('/api/test-security');

            $response->assertStatus(401);
        }
    }

    #[Test]
    public function xss_token_is_rejected(): void
    {
        $this->createProtectedRoute();

        $xssTokens = [
            '<script>alert("xss")</script>',
            'javascript:alert(1)',
            '{{constructor.constructor("return this")()}}',
        ];

        foreach ($xssTokens as $token) {
            $response = $this->withHeader('X-Auth-Token', $token)
                ->getJson('/api/test-security');

            $response->assertStatus(401);
        }
    }

    #[Test]
    public function sql_injection_token_is_rejected(): void
    {
        $this->createProtectedRoute();

        $sqlTokens = [
            "' OR '1'='1",
            "'; DROP TABLE users; --",
            "1' UNION SELECT * FROM users --",
        ];

        foreach ($sqlTokens as $token) {
            $response = $this->withHeader('X-Auth-Token', $token)
                ->getJson('/api/test-security');

            $response->assertStatus(401);
        }
    }

    #[Test]
    public function api_guard_is_set_correctly(): void
    {
        Route::middleware(['custom.auth'])->get('/api/test-guard', function () {
            return response()->json([
                'user_id' => Auth::id(),
            ]);
        });

        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/test-guard');

        $response->assertOk()
            ->assertJsonPath('user_id', $user->id);
    }
}
