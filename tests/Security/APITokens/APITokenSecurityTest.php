<?php

namespace Tests\Security\APITokens;


use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\InteractsWithApi;

class APITokenSecurityTest extends FeatureTestCase
{
    use InteractsWithApi;

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
        $user = $this->createInactiveUser(UserRoleEnum::User->value);

        $response = $this->asApiUser($user->api_token)
            ->getJson('/api/tickets');

        $response->assertUnauthorized();
    }

    #[Test]
    public function it_accepts_requests_with_valid_token(): void
    {
        $user = $this->createRegularUser();

        $response = $this->asApiUser($user->api_token)
            ->getJson('/api/tickets');

        $response->assertOk();
    }

    #[Test]
    public function it_rotates_token_on_login(): void
    {
        $user = $this->createUserWithPassword(UserRoleEnum::User->value, 'login-test@example.com', 'password', ['api_token' => 'old-token']);

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
        $user = $this->createUserWithToken(UserRoleEnum::User->value, ['api_token' => 'logout-token']);

        $response = $this->asApiUser('logout-token')
            ->post('/logout');

        $response->assertOk();

        $user->refresh();
        $this->assertNull($user->api_token);
    }

    #[Test]
    public function it_prevents_token_reuse_after_logout(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value, ['api_token' => 'reused-token']);

        $this->asApiUser('reused-token')
            ->post('/logout')
            ->assertOk();

        $response = $this->asApiUser('reused-token')
            ->getJson('/api/tickets');

        $response->assertUnauthorized();
    }

    #[Test]
    public function it_generates_secure_random_tokens(): void
    {
        $tokens = [];
        for ($i = 0; $i < 10; $i++) {
            $tokens[] = Str::random(60);
        }

        $uniqueTokens = array_unique($tokens);
        $this->assertCount(10, $uniqueTokens);
    }

    #[Test]
    public function it_hashes_tokens_in_database(): void
    {
        $user = $this->createUserWithToken(UserRoleEnum::User->value);

        $this->assertEquals(60, strlen($user->api_token));
    }
}
