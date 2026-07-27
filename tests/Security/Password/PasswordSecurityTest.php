<?php

namespace Tests\Security\Password;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class PasswordSecurityTest extends FeatureTestCase
{
    #[Test]
    public function it_rejects_password_shorter_than_8_chars_on_register(): void
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

    #[Test]
    public function it_rejects_password_confirmation_mismatch(): void
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
                'password' => 'Password123!',
                'password_confirmation' => 'different-password',
            ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['password']]);
    }

    #[Test]
    public function it_rejects_short_password_on_change(): void
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

    #[Test]
    public function it_stores_password_hashed_in_database(): void
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
