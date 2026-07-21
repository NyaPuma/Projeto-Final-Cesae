<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class SecuritySessionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
        UserProfile::create(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::create(['name' => User::ROLE_ADMIN]);
    }

    public function test_logout_clears_session_token(): void
    {
        $profileId = UserProfile::where('name', User::ROLE_USER)->value('id');
        $token = Str::random(60);
        $user = User::factory()->create([
            'profile_id' => $profileId,
            'password' => Hash::make('password123'),
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

    public function test_api_token_nullified_in_database_on_logout(): void
    {
        $profileId = UserProfile::where('name', User::ROLE_USER)->value('id');
        $token = Str::random(60);
        $user = User::factory()->create([
            'profile_id' => $profileId,
            'password' => Hash::make('password123'),
            'api_token' => $token,
        ]);

        $this->assertNotNull($user->api_token);

        $this->withHeader('X-Auth-Token', $token)
            ->postJson('/logout');

        $user->refresh();
        $this->assertNull($user->api_token);
    }

    public function test_new_login_generates_different_token(): void
    {
        $profileId = UserProfile::where('name', User::ROLE_USER)->value('id');
        $oldToken = Str::random(60);
        User::factory()->create([
            'email' => 'newlogintoken@example.com',
            'password' => Hash::make('password123'),
            'profile_id' => $profileId,
            'active' => true,
            'api_token' => $oldToken,
        ]);

        $response = $this->withSession([])->postJson('/login', [
            'email' => 'newlogintoken@example.com',
            'password' => 'password123',
        ]);

        $response->assertOk();
        $newToken = $response->json('token');
        $this->assertNotNull($newToken);
        $this->assertNotEquals($oldToken, $newToken);
    }
}
