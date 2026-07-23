<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Userprofile as UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
        UserProfile::create(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::create(['name' => User::ROLE_ADMIN]);
    }

    private function createAuthenticatedRoute(): void
    {
        Route::middleware(['custom.auth'])->get('/api/test-auth', function () {
            return response()->json(['message' => 'authenticated']);
        });
    }

    #[Test]
    public function authenticated_request_with_x_auth_token_succeeds(): void
    {
        $this->createAuthenticatedRoute();

        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/test-auth');

        $response->assertOk()
            ->assertJson(['message' => 'authenticated']);
    }

    #[Test]
    public function request_without_x_auth_token_returns_401(): void
    {
        $this->createAuthenticatedRoute();

        $response = $this->getJson('/api/test-auth');

        $response->assertStatus(401);
    }

    #[Test]
    public function request_with_invalid_token_returns_401(): void
    {
        $this->createAuthenticatedRoute();

        $response = $this->withHeader('X-Auth-Token', 'totally-invalid-token-value')
            ->getJson('/api/test-auth');

        $response->assertStatus(401);
    }

    #[Test]
    public function request_with_empty_token_returns_401(): void
    {
        $this->createAuthenticatedRoute();

        $response = $this->withHeader('X-Auth-Token', '')
            ->getJson('/api/test-auth');

        $response->assertStatus(401);
    }

    #[Test]
    public function request_with_null_token_returns_401(): void
    {
        $this->createAuthenticatedRoute();

        $response = $this->withHeader('X-Auth-Token', 'null')
            ->getJson('/api/test-auth');

        $response->assertStatus(401);
    }

    #[Test]
    public function request_with_bearer_token_succeeds(): void
    {
        $this->createAuthenticatedRoute();

        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('Authorization', 'Bearer '.$user->api_token)
            ->getJson('/api/test-auth');

        $response->assertOk();
    }

    #[Test]
    public function request_with_invalid_bearer_token_returns_401(): void
    {
        $this->createAuthenticatedRoute();

        $response = $this->withHeader('Authorization', 'Bearer invalid-token')
            ->getJson('/api/test-auth');

        $response->assertStatus(401);
    }

    #[Test]
    public function request_with_token_of_inactive_user_returns_401(): void
    {
        $this->createAuthenticatedRoute();

        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => false,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/test-auth');

        $response->assertStatus(401);
    }

    #[Test]
    public function request_with_token_of_deleted_user_returns_401(): void
    {
        $this->createAuthenticatedRoute();

        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $token = $user->api_token;
        $user->delete();

        $response = $this->withHeader('X-Auth-Token', $token)
            ->getJson('/api/test-auth');

        $response->assertStatus(401);
    }

    #[Test]
    public function token_is_not_leaked_in_user_response(): void
    {
        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        Route::middleware(['custom.auth'])->get('/api/test-user', function () {
            return response()->json(auth()->user());
        });

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/test-user');

        $response->assertOk();
        $response->assertJsonMissing(['api_token' => $user->api_token]);
    }

    #[Test]
    public function user_without_profile_is_denied(): void
    {
        $this->createAuthenticatedRoute();

        $user = User::factory()->create([
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        \DB::table('users')->where('id', $user->id)->update(['profile_id' => null]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/test-auth');

        $response->assertStatus(403);
    }

    #[Test]
    public function concurrent_logins_only_last_token_works(): void
    {
        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'password' => Hash::make('secret123'),
            'active' => true,
        ]);

        $firstToken = $user->api_token;

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret123',
        ]);

        $this->createAuthenticatedRoute();

        $response = $this->withHeader('X-Auth-Token', $firstToken)
            ->getJson('/api/test-auth');

        $response->assertStatus(401);

        $user->refresh();
        $response2 = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/test-auth');

        $response2->assertOk();
    }
}
