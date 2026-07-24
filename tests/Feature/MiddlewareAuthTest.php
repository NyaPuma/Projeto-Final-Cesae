<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Userprofile as UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MiddlewareAuthTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
        UserProfile::create(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::create(['name' => User::ROLE_ADMIN]);
    }

    #[Test]
    public function unauthenticated_users_are_blocked(): void
    {
        Route::middleware(['custom.auth'])->get('/api/test-blocked', function () {
            return response()->json(['message' => 'should not reach']);
        });

        $response = $this->getJson('/api/test-blocked');

        $response->assertStatus(401);
    }

    #[Test]
    public function authenticated_users_are_allowed(): void
    {
        Route::middleware(['custom.auth'])->get('/api/test-allowed', function () {
            return response()->json(['message' => 'allowed']);
        });

        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/test-allowed');

        $response->assertOk()
            ->assertJson(['message' => 'allowed']);
    }

    #[Test]
    public function inactive_users_are_blocked(): void
    {
        Route::middleware(['custom.auth'])->get('/api/test-inactive', function () {
            return response()->json(['message' => 'should not reach']);
        });

        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => false,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/test-inactive');

        $response->assertStatus(401);
    }

    #[Test]
    public function users_without_profile_are_blocked(): void
    {
        Route::middleware(['custom.auth'])->get('/api/test-no-profile', function () {
            return response()->json(['message' => 'should not reach']);
        });

        $user = User::factory()->create([
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        \DB::table('users')->where('id', $user->id)->update(['profile_id' => null]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/test-no-profile');

        $response->assertStatus(403);
    }

    #[Test]
    public function role_middleware_allows_correct_role(): void
    {
        Route::middleware(['custom.auth', 'role:admin'])->get('/api/test-admin', function () {
            return response()->json(['message' => 'admin access']);
        });

        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->first();
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->getJson('/api/test-admin');

        $response->assertOk()
            ->assertJson(['message' => 'admin access']);
    }

    #[Test]
    public function role_middleware_blocks_wrong_role(): void
    {
        Route::middleware(['custom.auth', 'role:admin'])->get('/api/test-admin-block', function () {
            return response()->json(['message' => 'should not reach']);
        });

        $userProfile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $userProfile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->getJson('/api/test-admin-block');

        $response->assertStatus(403);
    }

    #[Test]
    public function role_middleware_blocks_unauthenticated(): void
    {
        Route::middleware(['custom.auth', 'role:admin'])->get('/api/test-admin-unauth', function () {
            return response()->json(['message' => 'should not reach']);
        });

        $response = $this->getJson('/api/test-admin-unauth');

        $response->assertStatus(401);
    }

    #[Test]
    public function technician_role_allowed_on_technician_route(): void
    {
        Route::middleware(['custom.auth', 'role:technician'])->get('/api/test-tech', function () {
            return response()->json(['message' => 'tech access']);
        });

        $techProfile = UserProfile::where('name', User::ROLE_TECHNICIAN)->first();
        $tech = User::factory()->create([
            'profile_id' => $techProfile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $tech->api_token)
            ->getJson('/api/test-tech');

        $response->assertOk()
            ->assertJson(['message' => 'tech access']);
    }

    #[Test]
    public function admin_role_allowed_on_admin_route(): void
    {
        Route::middleware(['custom.auth', 'role:admin'])->get('/api/test-admin-ok', function () {
            return response()->json(['message' => 'admin ok']);
        });

        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->first();
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->getJson('/api/test-admin-ok');

        $response->assertOk()
            ->assertJson(['message' => 'admin ok']);
    }
}
