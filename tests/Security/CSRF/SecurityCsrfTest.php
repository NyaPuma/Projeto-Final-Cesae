<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class SecurityCsrfTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);
    }

    public function test_login_does_not_require_csrf_token(): void
    {
        $profileId = UserProfile::where('name', UserRoleEnum::User->value)->value('id');
        User::factory()->create([
            'email' => 'nocsrf@example.com',
            'password' => Hash::make('Password123!'),
            'profile_id' => $profileId,
            'active' => true,
            'api_token' => Str::random(60),
        ]);

        $response = $this->withSession([])
            ->postJson('/api/login', [
                'email' => 'nocsrf@example.com',
                'password' => 'Password123!',
            ]);

        $response->assertOk();
    }

    public function test_api_routes_do_not_require_csrf_token(): void
    {
        $profileId = UserProfile::where('name', UserRoleEnum::User->value)->value('id');
        $user = User::factory()->create([
            'profile_id' => $profileId,
            'api_token' => Str::random(60),
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/tickets', [
                'title' => 'CSRF bypass test',
                'description' => 'Testing API without CSRF token',
                'priority' => 'baixa',
            ]);

        $this->assertNotEquals(419, $response->status(), 'CSRF middleware should not block API requests');
    }

    public function test_logout_requires_authentication(): void
    {
        $response = $this->postJson('/logout');

        $response->assertStatus(401);
    }

    public function test_password_change_requires_authentication(): void
    {
        $response = $this->postJson('/api/password/change', [
            'current_password' => 'anything',
            'new_password' => 'new-password-123',
        ]);

        $response->assertStatus(401);
    }
}
