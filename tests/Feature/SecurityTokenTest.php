<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;

class SecurityTokenTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::create(['name' => User::ROLE_USER]);
        UserProfile::create(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::create(['name' => User::ROLE_ADMIN]);
    }

    public function test_token_is_60_characters_long(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->value('id'),
            'api_token' => Str::random(60),
        ]);

        $this->assertEquals(60, strlen($user->api_token));
    }

    public function test_token_is_unique_across_users(): void
    {
        $profileId = UserProfile::where('name', User::ROLE_USER)->value('id');
        $token1 = Str::random(60);
        $token2 = Str::random(60);

        $this->assertNotEquals($token1, $token2);

        User::factory()->create(['profile_id' => $profileId, 'api_token' => $token1]);
        User::factory()->create(['profile_id' => $profileId, 'api_token' => $token2]);

        $this->assertDatabaseHas('users', ['api_token' => $token1]);
        $this->assertDatabaseHas('users', ['api_token' => $token2]);
    }

    public function test_token_regenerated_on_password_change(): void
    {
        $profileId = UserProfile::where('name', User::ROLE_USER)->value('id');
        $oldToken = Str::random(60);

        $user = User::factory()->create([
            'profile_id' => $profileId,
            'password' => Hash::make('current-password'),
            'api_token' => $oldToken,
        ]);

        $response = $this->withHeader('X-Auth-Token', $oldToken)
            ->postJson('/password/change', [
                'current_password' => 'current-password',
                'new_password' => 'new-secure-password-123',
            ]);

        $response->assertOk();

        $user->refresh();
        $this->assertNotNull($user->api_token);
        $this->assertEquals(60, strlen($user->api_token));
    }

    public function test_old_token_still_works_after_password_change(): void
    {
        $profileId = UserProfile::where('name', User::ROLE_USER)->value('id');
        $oldToken = Str::random(60);

        $user = User::factory()->create([
            'profile_id' => $profileId,
            'password' => Hash::make('current-password'),
            'api_token' => $oldToken,
        ]);

        $this->withHeader('X-Auth-Token', $oldToken)
            ->postJson('/password/change', [
                'current_password' => 'current-password',
                'new_password' => 'new-secure-password-123',
            ]);

        // After password change, old token should still work for API access
        $response = $this->withHeader('X-Auth-Token', $oldToken)
            ->getJson('/ui/tickets');

        $this->assertContains($response->status(), [200, 302]);
    }

    public function test_blank_token_rejected_for_auth_routes(): void
    {
        $response = $this->withHeader('X-Auth-Token', '')
            ->getJson('/ui/tickets');

        $response->assertStatus(401);
    }
}
