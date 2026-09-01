<?php

namespace Tests\Concerns;

use Illuminate\Support\Str;

trait InteractsWithApi
{
    /**
     * The last HTTP response instance.
     *
     * @var \Illuminate\Testing\TestResponse|null
     */
    protected $response;
    protected function withApiHeaders(): self
    {
        return $this->withHeader('Accept', 'application/json')
            ->withHeader('Content-Type', 'application/json');
    }

    protected function withAuthToken(string $token): self
    {
        return $this->withHeader('X-Auth-Token', $token)
            ->withApiHeaders();
    }

    protected function asApiUser(string $token): self
    {
        return $this->withAuthToken($token);
    }

    protected function asUserWithToken($user): self
    {
        return $this->withHeader('X-Auth-Token', $user->api_token);
    }

    protected function withApiUser(string $token): self
    {
        return $this->asApiUser($token);
    }

    protected function generateApiToken(): string
    {
        return Str::random(60);
    }

    protected function assertApiResponse(array $expectedStructure): void
    {
        $this->response->assertJsonStructure($expectedStructure);
    }

    protected function assertApiResponsePath(string $path, mixed $expected): void
    {
        $this->response->assertJsonPath($path, $expected);
    }

    protected function assertApiValidationErrors(array $fields): void
    {
        $this->response->assertStatus(422)
            ->assertJsonValidationErrors($fields);
    }

    protected function assertApiUnauthorized(): void
    {
        $this->response->assertUnauthorized();
    }

    protected function assertApiForbidden(): void
    {
        $this->response->assertForbidden();
    }

    protected function assertApiNotFound(): void
    {
        $this->response->assertNotFound();
    }

    protected function assertApiSuccess(): void
    {
        $this->response->assertOk();
    }

    protected function assertApiCreated(): void
    {
        $this->response->assertCreated();
    }

    protected function assertApiNoContent(): void
    {
        $this->response->assertNoContent();
    }
}
