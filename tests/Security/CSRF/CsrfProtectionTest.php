<?php

namespace Tests\Security\CSRF;


use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class CsrfProtectionTest extends FeatureTestCase
{
    #[Test]
    public function it_allows_login_without_csrf_token(): void
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
            ->postJson('/login', [
                'email' => 'nocsrf@example.com',
                'password' => 'Password123!',
            ]);

        $response->assertOk();
    }

    #[Test]
    public function it_skips_csrf_for_api_routes(): void
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

    #[Test]
    public function it_requires_authentication_for_logout(): void
    {
        $response = $this->postJson('/logout');

        $response->assertStatus(401);
    }

    #[Test]
    public function it_requires_authentication_for_password_change(): void
    {
        $response = $this->postJson('/password/change', [
            'current_password' => 'anything',
            'new_password' => 'new-password-123',
        ]);

        $response->assertStatus(401);
    }
}
