<?php

namespace Tests\Feature;


use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthEdgeCasesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // These assertions expect the English message strings.
        app()->setLocale('en-GB');

        UserProfile::create(['name' => UserRoleEnum::User->value]);
        UserProfile::create(['name' => UserRoleEnum::Technician->value]);
        UserProfile::create(['name' => UserRoleEnum::Admin->value]);
    }

    public function test_register_rejects_duplicate_email(): void
    {
        $adminProfile = UserProfile::where('name', UserRoleEnum::Admin->value)->firstOrFail();
        $userProfile = UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail();

        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);

        $email = 'dup@example.com';

        User::factory()->create([
            'email' => $email,
            'password' => Hash::make('Password123!'),
            'profile_id' => $userProfile->id,
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/admin/users/register', [
                'name' => 'Dup User',
                'email' => $email,
                'password' => 'Password123!',
                'password_confirmation' => 'Password123!',
            ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['email']]);
    }

    public function test_login_rejects_inactive_user(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail()->id,
            'api_token' => Str::random(60),
            'active' => false,
            'password' => Hash::make('Password123!'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'Password123!',
        ]);

        $response->assertStatus(401);
        $response->assertJson(['message' => 'Invalid credentials.']);
    }

    public function test_login_replaces_api_token_and_invalidates_old_token(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail()->id,
            'active' => true,
            'password' => Hash::make('Password123!'),
            'api_token' => Str::random(60),
        ]);

        $oldToken = $user->api_token;

        $login = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'Password123!',
        ]);

        $login->assertOk();
        $newToken = $login->json('token');
        $this->assertNotEquals($oldToken, $newToken);

        $logoutOld = $this->withHeader('X-Auth-Token', $oldToken)->postJson('/logout');
        $logoutOld->assertStatus(401);
    }

    public function test_password_change_rejects_wrong_current_password(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail()->id,
            'active' => true,
            'password' => Hash::make('Password123!'),
            'api_token' => Str::random(60),
            'locale' => 'en-GB',
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/password/change', [
                'current_password' => 'wrong-password',
                'new_password' => 'Password123!',
            ]);

        $response->assertStatus(403);
        $response->assertJson(['message' => 'Current password is incorrect']);

        $user->refresh();
        $this->assertTrue(Hash::check('Password123!', $user->password));
        $this->assertFalse(Hash::check('newpassword456', $user->password));
    }

    public function test_password_change_requires_new_password_min_8(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail()->id,
            'active' => true,
            'password' => Hash::make('Password123!'),
            'api_token' => Str::random(60),
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/password/change', [
                'current_password' => 'Password123!',
                'new_password' => 'short',
            ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['new_password']]);
    }

    public function test_logout_clears_api_token_in_database(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail()->id,
            'active' => true,
            'password' => Hash::make('Password123!'),
            'api_token' => Str::random(60),
        ]);

        $this->assertNotNull($user->api_token);

        $logout = $this->withHeader('X-Auth-Token', $user->api_token)->postJson('/logout');
        $logout->assertOk();

        $user->refresh();
        $this->assertNull($user->api_token);
    }

    public function test_password_change_requires_all_strength_rules(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->firstOrFail()->id,
            'active' => true,
            'password' => Hash::make('Password123!'),
            'api_token' => Str::random(60),
        ]);

        $send = fn (array $payload) => $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/password/change', $payload);

        // Sem current_password
        $send(['new_password' => 'StrongPass1!'])->assertStatus(422)
            ->assertJsonValidationErrors(['current_password']);

        // Sem new_password
        $send(['current_password' => 'Password123!'])->assertStatus(422)
            ->assertJsonValidationErrors(['new_password']);

        // Same as current
        $send(['current_password' => 'Password123!', 'new_password' => 'Password123!'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['new_password']);

        // Missing symbol
        $send(['current_password' => 'Password123!', 'new_password' => 'Password123'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['new_password']);

        // Only lowercase
        $send(['current_password' => 'Password123!', 'new_password' => 'onlylower123'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['new_password']);

        // No numbers
        $send(['current_password' => 'Password123!', 'new_password' => 'NoNumbers!'])
            ->assertStatus(422)
            ->assertJsonValidationErrors(['new_password']);
    }
}
