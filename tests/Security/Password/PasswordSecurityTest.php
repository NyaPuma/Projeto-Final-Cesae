<?php

namespace Tests\Security\Password;

use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class PasswordSecurityTest extends FeatureTestCase
{
    #[Test]
    public function it_rejects_password_shorter_than_8_chars_on_register(): void
    {
        $admin = $this->createAdmin();

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
        $admin = $this->createAdmin();

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
        $user = $this->createUserWithPassword(UserRoleEnum::User->value, 'shortpwchange@example.com', 'current-password');

        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->postJson('/api/password/change', [
                'current_password' => 'current-password',
                'new_password' => 'short',
            ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['errors' => ['new_password']]);
    }

    #[Test]
    public function it_stores_password_hashed_in_database(): void
    {
        $user = $this->createUserWithPassword(UserRoleEnum::User->value, 'hashtest@example.com', 'plain-text-password');

        $this->assertNotEquals('plain-text-password', $user->password);
        $this->assertTrue(Hash::check('plain-text-password', $user->password));
        $this->assertStringStartsWith('$2y$', $user->password);
    }
}
