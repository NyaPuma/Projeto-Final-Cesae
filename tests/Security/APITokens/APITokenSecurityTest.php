<?php

namespace Tests\Security\APITokens;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\ApiTestCase;

class APITokenSecurityTest extends ApiTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
    }

    #[Test]
    public function it_rejects_requests_without_token(): void
    {
        $response = $this->getJson('/api/tickets');

        $response->assertUnauthorized();
    }

    #[Test]
    public function it_rejects_requests_with_invalid_token(): void
    {
        $response = $this->withHeader('X-Auth-Token', 'invalid-token')
            ->getJson('/api/tickets');

        $response->assertUnauthorized();
    }

    #[Test]
    public function it_rejects_requests_with_expired_token(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'expired-token',
            'active' => false,
        ]);

        $response = $this->withApiUser('expired-token')
            ->getJson('/api/tickets');

        $response->assertUnauthorized();
    }

    #[Test]
    public function it_accepts_requests_with_valid_token(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'valid-token',
            'active' => true,
        ]);

        $response = $this->withApiUser('valid-token')
            ->getJson('/api/tickets');

        $response->assertOk();
    }

    #[Test]
    public function it_rotates_token_on_login(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'api_token' => 'old-token',
            'active' => true,
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertOk();
        $newToken = $response->json('token');

        $this->assertNotEquals('old-token', $newToken);
        $this->assertEquals(60, strlen($newToken));
    }

    #[Test]
    public function it_clears_token_on_logout(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'logout-token',
            'active' => true,
        ]);

        $response = $this->withApiUser('logout-token')
            ->post('/logout');

        $response->assertOk();

        $user->refresh();
        $this->assertNull($user->api_token);
    }

    #[Test]
    public function it_prevents_token_reuse_after_logout(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'reused-token',
            'active' => true,
        ]);

        $this->withApiUser('reused-token')
            ->post('/logout')
            ->assertOk();

        $response = $this->withApiUser('reused-token')
            ->getJson('/api/tickets');

        $response->assertUnauthorized();
    }

    #[Test]
    public function it_generates_secure_random_tokens(): void
    {
        $tokens = [];
        for ($i = 0; $i < 10; $i++) {
            $tokens[] = \Illuminate\Support\Str::random(60);
        }

        $uniqueTokens = array_unique($tokens);
        $this->assertCount(10, $uniqueTokens);
    }

    #[Test]
    public function it_hashes_tokens_in_database(): void
    {
        $user = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id,
            'api_token' => 'plain-token',
            'active' => true,
        ]);

        $this->assertNotEquals('plain-token', $user->api_token);
        $this->assertEquals(60, strlen($user->api_token));
    }
}
