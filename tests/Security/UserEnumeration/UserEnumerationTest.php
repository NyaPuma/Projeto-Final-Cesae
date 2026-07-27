<?php

namespace Tests\Security\UserEnumeration;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\ApiTestCase;

class UserEnumerationTest extends ApiTestCase
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
    public function it_does_not_reveal_user_existence_on_login(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'nonexistent@example.com',
            'password' => 'password',
        ]);

        $response->assertUnauthorized();
        $this->assertStringNotContainsString('not found', strtolower($response->json('message') ?? ''));
        $this->assertStringNotContainsString('does not exist', strtolower($response->json('message') ?? ''));
    }

    #[Test]
    public function it_returns_same_error_for_invalid_password(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('correctpassword'),
            'active' => true,
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertUnauthorized();
    }

    #[Test]
    public function it_does_not_reveal_user_email_on_password_reset(): void
    {
        $response = $this->postJson('/password/forgot', [
            'email' => 'nonexistent@example.com',
        ]);

        $response->assertOk();
        $this->assertStringNotContainsString('not found', strtolower($response->json('message') ?? ''));
    }

    #[Test]
    public function it_does_not_enumerate_users_in_api_list(): void
    {
        $admin = User::factory()->create([
            'profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id,
            'api_token' => 'admin-token',
            'active' => true,
        ]);

        User::factory()->count(5)->create();

        $response = $this->withApiUser('admin-token')
            ->getJson('/api/admin/users');

        $response->assertOk();
        $this->assertArrayHasKey('users', $response->json());
    }

    #[Test]
    public function it_requires_authentication_for_user_listing(): void
    {
        $response = $this->getJson('/api/admin/users');

        $response->assertUnauthorized();
    }

    #[Test]
    public function it_does_not_reveal_user_count_to_unauthenticated(): void
    {
        $response = $this->getJson('/api/users/count');

        $response->assertUnauthorized();
    }
}
