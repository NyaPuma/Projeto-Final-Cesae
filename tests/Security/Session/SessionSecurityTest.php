<?php

namespace Tests\Security\Session;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class SessionSecurityTest extends FeatureTestCase
{
    #[Test]
    public function it_clears_session_token_on_logout(): void
    {
        $profileId = UserProfile::where('name', User::ROLE_USER)->value('id');
        $token = Str::random(60);
        $user = User::factory()->create([
            'profile_id' => $profileId,
            'password' => Hash::make('Password123!'),
            'api_token' => $token,
        ]);

        $sessionToken = session()->get('api_token');
        $this->assertNull($sessionToken);

        $response = $this->withHeader('X-Auth-Token', $token)
            ->postJson('/logout');

        $response->assertOk();

        $user->refresh();
        $this->assertNull($user->api_token);
    }

    #[Test]
    public function it_nullifies_api_token_in_database_on_logout(): void
    {
        $profileId = UserProfile::where('name', User::ROLE_USER)->value('id');
        $token = Str::random(60);
        $user = User::factory()->create([
            'profile_id' => $profileId,
            'password' => Hash::make('Password123!'),
            'api_token' => $token,
        ]);

        $this->assertNotNull($user->api_token);

        $this->withHeader('X-Auth-Token', $token)
            ->postJson('/logout');

        $user->refresh();
        $this->assertNull($user->api_token);
    }

    #[Test]
    public function it_generates_different_token_on_new_login(): void
    {
        $profileId = UserProfile::where('name', User::ROLE_USER)->value('id');
        $oldToken = Str::random(60);
        User::factory()->create([
            'email' => 'newlogintoken@example.com',
            'password' => Hash::make('Password123!'),
            'profile_id' => $profileId,
            'active' => true,
            'api_token' => $oldToken,
        ]);

        $response = $this->withSession([])->postJson('/login', [
            'email' => 'newlogintoken@example.com',
            'password' => 'Password123!',
        ]);

        $response->assertOk();
        $newToken = $response->json('token');
        $this->assertNotNull($newToken);
        $this->assertNotEquals($oldToken, $newToken);
    }
}
