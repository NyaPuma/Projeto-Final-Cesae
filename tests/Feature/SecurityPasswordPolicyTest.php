<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class SecurityPasswordPolicyTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
        UserProfile::create(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::create(['name' => User::ROLE_ADMIN]);
    }

    public function test_password_minimum_8_characters_required_on_register(): void
    {
        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->firstOrFail();
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/admin/users/register', [
                'name' => 'Short Password User',
                'email' => 'shortpw@example.com',
                'password' => '1234567',
                'password_confirmation' => '1234567',
            ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['password']]);
    }

    public function test_password_confirmation_mismatch_rejected(): void
    {
        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->firstOrFail();
        $admin = User::factory()->create([
            'profile_id' => $adminProfile->id,
            'api_token' => Str::random(60),
        ]);

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson('/admin/users/register', [
                'name' => 'Mismatch User',
                'email' => 'mismatch@example.com',
                'password' => 'password123',
                'password_confirmation' => 'different-password',
            ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['password']]);
    }

    public function test_password_change_requires_minimum_8_characters(): void
    {
        $profileId = UserProfile::where('name', User::ROLE_USER)->value('id');
        $user = User::factory()->create([
            'profile_id' => $profileId,
            'password' => Hash::make('current-password'),
            'api_token' => Str::random(60),
        ]);

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/password/change', [
                'current_password' => 'current-password',
                'new_password' => 'short',
            ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['new_password']]);
    }

    public function test_password_is_stored_hashed(): void
    {
        $profileId = UserProfile::where('name', User::ROLE_USER)->value('id');
        $user = User::create([
            'name' => 'Hash Test User',
            'email' => 'hashtest@example.com',
            'profile_id' => $profileId,
            'password' => Hash::make('plain-text-password'),
            'api_token' => Str::random(60),
        ]);

        $user->refresh();
        $this->assertNotEquals('plain-text-password', $user->password);
        $this->assertTrue(Hash::check('plain-text-password', $user->password));
        $this->assertStringStartsWith('$argon2id$', $user->password);
    }
}
