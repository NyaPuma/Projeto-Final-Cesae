<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Userprofile as UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthenticationTest extends TestCase
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
    public function login_with_valid_credentials_returns_token(): void
    {
        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'password' => Hash::make('secret123'),
            'active' => true,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret123',
        ]);

        $response->assertOk()
            ->assertJsonStructure(['user', 'token'])
            ->assertJsonPath('user.email', $user->email);

        $token = $response->json('token');
        $this->assertNotEmpty($token);
        $this->assertEquals(60, strlen($token));
    }

    #[Test]
    public function login_with_invalid_password_returns_401(): void
    {
        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'password' => Hash::make('secret123'),
            'active' => true,
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401);
    }

    #[Test]
    public function login_with_nonexistent_user_returns_401(): void
    {
        $response = $this->post('/api/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'anypassword',
        ]);

        $response->assertStatus(401);
    }

    #[Test]
    public function login_with_inactive_user_returns_401(): void
    {
        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'password' => Hash::make('secret123'),
            'active' => false,
        ]);

        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'secret123',
        ]);

        $response->assertStatus(401);
    }

    #[Test]
    public function login_with_missing_fields_returns_422(): void
    {
        $response = $this->post('/api/login', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email', 'password']);
    }

    #[Test]
    public function login_rotates_token_and_invalidates_old(): void
    {
        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'password' => Hash::make('secret123'),
            'active' => true,
        ]);

        $oldToken = $user->api_token;

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'secret123',
        ]);

        $response->assertOk();
        $newToken = $response->json('token');
        $this->assertNotEquals($oldToken, $newToken);
        $this->assertEquals(60, strlen($newToken));

        $user->refresh();
        $this->assertNotEquals($newToken, $user->api_token);
        $this->assertEquals(User::hashToken($newToken), $user->api_token);
    }

    #[Test]
    public function logout_clears_token_in_database(): void
    {
        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->post('/logout');

        $response->assertOk();

        $user->refresh();
        $this->assertNull($user->api_token);
    }

    #[Test]
    public function logout_without_token_returns_401(): void
    {
        $response = $this->postJson('/logout');

        $response->assertStatus(401);
    }

    #[Test]
    public function registration_creates_user_with_token(): void
    {
        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->first();
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        $userProfile = UserProfile::where('name', User::ROLE_USER)->first();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/api/admin/users', [
                'name' => 'New User',
                'email' => 'newuser@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'profile_id' => $userProfile->id,
            ]);

        $response->assertCreated();

        $createdUser = User::where('email', 'newuser@example.com')->first();
        $this->assertNotNull($createdUser);
        $this->assertNotEmpty($createdUser->api_token);
        $this->assertEquals(64, strlen($createdUser->api_token));
    }

    #[Test]
    public function registration_rejects_duplicate_email(): void
    {
        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->first();
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
            'active' => true,
        ]);

        User::factory()->create([
            'email' => 'existing@example.com',
        ]);

        $userProfile = UserProfile::where('name', User::ROLE_USER)->first();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/api/admin/users', [
                'name' => 'Duplicate User',
                'email' => 'existing@example.com',
                'password' => 'password123',
                'password_confirmation' => 'password123',
                'profile_id' => $userProfile->id,
            ]);

        $response->assertStatus(422);
    }

    #[Test]
    public function change_password_with_correct_current_password_succeeds(): void
    {
        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'password' => Hash::make('oldpassword'),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->post('/password/change', [
                'current_password' => 'oldpassword',
                'new_password' => 'newpassword123',
            ]);

        $response->assertOk();
    }

    #[Test]
    public function change_password_with_wrong_current_password_returns_403(): void
    {
        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => Str::random(60),
            'password' => Hash::make('correctpassword'),
            'active' => true,
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->post('/password/change', [
                'current_password' => 'wrongpassword',
                'new_password' => 'newpassword123',
            ]);

        $response->assertStatus(403);
    }
}
