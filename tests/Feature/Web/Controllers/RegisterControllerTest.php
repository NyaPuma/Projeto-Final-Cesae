<?php

namespace Tests\Feature\Web\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class RegisterControllerTest extends FeatureTestCase
{
    private const REGISTER_URL = '/admin/users/register';

    private function registerPayload(array $overrides = []): array
    {
        return array_merge([
            'name' => 'Novo Utilizador',
            'email' => 'novo@example.com',
            'password' => 'Password123!',
            'password_confirmation' => 'Password123!',
        ], $overrides);
    }

    #[Test]
    public function admin_registers_regular_active_user_with_token(): void
    {
        $admin = $this->createAdmin();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson(self::REGISTER_URL, $this->registerPayload());

        $response->assertStatus(201)
            ->assertJsonStructure(['user' => ['id', 'name', 'email'], 'token'])
            ->assertJsonMissingPath('user.api_token');

        $this->assertNotEmpty($response->json('token'));

        $user = User::where('email', 'novo@example.com')->firstOrFail();

        $this->assertEquals('Novo Utilizador', $user->name);
        $this->assertEquals(
            UserProfile::where('name', UserRoleEnum::User->value)->value('id'),
            $user->profile_id,
        );
        $this->assertTrue((bool) $user->active);
        $this->assertTrue(Hash::check('Password123!', $user->password));
        $this->assertNotEquals($response->json('token'), $user->api_token);
    }

    #[Test]
    public function admin_registration_does_not_assume_admin_session_or_cookies(): void
    {
        $admin = $this->createAdmin();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson(self::REGISTER_URL, $this->registerPayload());

        $response->assertStatus(201)
            ->assertCookieMissing('api_token')
            ->assertCookieMissing('auth_token');

        $this->withHeader('X-Auth-Token', $admin->api_token)
            ->getJson('/ui/users')
            ->assertOk();
    }

    #[Test]
    public function register_rejects_duplicate_email(): void
    {
        $admin = $this->createAdmin();
        $this->createUserWithPassword(UserRoleEnum::User->value, 'novo@example.com', 'Password123!');

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson(self::REGISTER_URL, $this->registerPayload());

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    #[Test]
    public function register_normalizes_email_to_lowercase(): void
    {
        $admin = $this->createAdmin();

        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson(self::REGISTER_URL, $this->registerPayload([
                'email' => 'NOVO@Example.COM',
            ]));

        $response->assertStatus(201);

        $this->assertDatabaseHas('users', ['email' => 'novo@example.com']);
    }

    #[Test]
    public function register_requires_admin_role(): void
    {
        $regular = $this->createRegularUser();

        $response = $this->withHeader('X-Auth-Token', $regular->api_token)
            ->postJson(self::REGISTER_URL, $this->registerPayload());

        $response->assertForbidden();
    }

    #[Test]
    public function register_requires_authentication(): void
    {
        $response = $this->postJson(self::REGISTER_URL, $this->registerPayload());

        $response->assertUnauthorized();
    }

    #[Test]
    public function register_validation_errors(): void
    {
        $admin = $this->createAdmin();
        $send = fn (array $payload) => $this->withHeader('X-Auth-Token', $admin->api_token)
            ->postJson(self::REGISTER_URL, $payload);

        // Campos obrigatórios em falta
        $send([])->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);

        // Email mal formatado
        $send($this->registerPayload(['email' => 'not-an-email']))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['email']);

        // Confirmação de password não coincide
        $send($this->registerPayload(['password_confirmation' => 'Different123!']))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);

        // Password fraca (sem símbolo)
        $send($this->registerPayload(['password' => 'WeakPass123', 'password_confirmation' => 'WeakPass123']))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['password']);

        // Name apenas com espaços colapsa para string vazia
        $send($this->registerPayload(['name' => '   ']))
            ->assertStatus(422)
            ->assertJsonValidationErrors(['name']);
    }
}
