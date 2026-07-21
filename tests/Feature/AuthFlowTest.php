<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
        UserProfile::create(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::create(['name' => User::ROLE_ADMIN]);
    }

    public function test_register_rejects_invalid_payload(): void
    {
        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->firstOrFail();

        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => \Illuminate\Support\Str::random(60),
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/admin/users/register', [
                'name' => '',
                'email' => 'invalid',
                'password' => 'short',
            ]);

        $response->assertStatus(422);
    }

    public function test_inactive_user_cannot_login(): void
    {
        User::factory()->create([
            'name' => 'Inactive User',
            'email' => 'inactive@example.com',
            'password' => Hash::make('password123'),
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->value('id'),
            'active' => false,
        ]);

        $response = $this->withSession([])->postJson('/api/login', [
            'email' => 'inactive@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(401);
        $response->assertJson(['message' => 'Invalid credentials.']);
    }

    public function test_login_does_not_require_csrf_token(): void
    {
        User::create([
            'name' => 'Demo User',
            'email' => 'demo@example.com',
            'password' => Hash::make('password123'),
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->value('id'),
            'active' => true,
            'api_token' => Str::random(60),
        ]);

        $response = $this->withSession([])->postJson('/login', [
            'email' => 'demo@example.com',
            'password' => 'password123',
        ]);

        $response->assertOk();
        $response->assertJsonStructure(['user', 'token']);
    }

    public function test_change_password_rejects_wrong_current_password(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->value('id'),
            'api_token' => Str::random(60),
            'password' => Hash::make('password123'),
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/password/change', [
                'current_password' => 'wrong-password',
                'new_password' => 'new-password-123',
            ]);

        $response->assertStatus(403);
        $response->assertJson(['message' => 'Current password is incorrect']);
    }
}
