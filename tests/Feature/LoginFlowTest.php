<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginFlowTest extends TestCase
{
    use RefreshDatabase;

    private function seedAll(): void
    {
        \Illuminate\Support\Facades\Artisan::call('db:seed');
    }

    public function test_login_returns_valid_token_and_cookie(): void
    {
        $this->seedAll();

        $login = $this->postJson('/login', [
            'email' => 'admin@example.com',
            'password' => 'admin123',
        ]);

        $login->assertOk();
        $this->assertNotEmpty($login->json('token'));

        $token = $login->json('token');
        $this->assertDatabaseHas('users', [
            'email' => 'admin@example.com',
            'api_token' => \App\Models\User::hashToken($token),
        ]);
    }

    public function test_ui_pages_work_with_api_token_cookie(): void
    {
        $this->seedAll();

        $login = $this->postJson('/login', [
            'email' => 'admin@example.com',
            'password' => 'admin123',
        ]);
        $login->assertOk();
        $token = $login->json('token');

        $this->withCookie('api_token', $token);

        $pages = ['/ui', '/ui/tickets', '/ui/rooms', '/ui/users', '/ui/analytics'];
        foreach ($pages as $page) {
            $response = $this->get($page);
            $this->assertEquals(
                200,
                $response->getStatusCode(),
                "Expected 200 for {$page}, got " . $response->getStatusCode()
            );
        }
    }

    public function test_ui_pages_work_with_auth_token_cookie(): void
    {
        $this->seedAll();

        $login = $this->postJson('/login', [
            'email' => 'admin@example.com',
            'password' => 'admin123',
        ]);
        $login->assertOk();
        $token = $login->json('token');

        $this->withCookie('auth_token', $token);

        $pages = ['/ui', '/ui/tickets', '/ui/rooms', '/ui/users', '/ui/analytics'];
        foreach ($pages as $page) {
            $response = $this->get($page);
            $this->assertEquals(
                200,
                $response->getStatusCode(),
                "Expected 200 for {$page}, got " . $response->getStatusCode()
            );
        }
    }

    public function test_full_browser_cookie_flow(): void
    {
        $this->seedAll();

        $login = $this->postJson('/login', [
            'email' => 'admin@example.com',
            'password' => 'admin123',
        ]);
        $login->assertOk();
        $token = $login->json('token');

        $this->withCookie('api_token', $token);
        $this->withCookie('auth_token', $token);

        $ui = $this->get('/ui');
        $ui->assertOk();

        $tickets = $this->get('/ui/tickets');
        $tickets->assertOk();
    }

    public function test_unauthenticated_access_redirects_to_login(): void
    {
        $this->seedAll();

        $response = $this->get('/ui/tickets');
        $response->assertRedirect('/ui/login');
    }

    public function test_redirect_url_includes_correct_port(): void
    {
        $this->seedAll();

        $response = $this->get('/ui/tickets');
        $redirectUrl = $response->headers->get('Location');
        $this->assertNotNull($redirectUrl);
        $this->assertStringContainsString('/ui/login', $redirectUrl);
    }

    public function test_middleware_redirect_returns_valid_html(): void
    {
        $this->seedAll();

        $response = $this->get('/ui/tickets');
        $body = $response->getContent();
        $this->assertNotEmpty($body);
        $this->assertStringContainsString('<!DOCTYPE html', $body);
        $this->assertStringContainsString('/ui/login', $body);
    }

    public function test_login_and_redirect_to_ui(): void
    {
        $this->seedAll();

        $login = $this->postJson('/login', [
            'email' => 'admin@example.com',
            'password' => 'admin123',
        ]);
        $login->assertOk();
        $token = $login->json('token');

        $this->withCookie('api_token', $token);
        $this->withCookie('auth_token', $token);

        $ui = $this->get('/ui');
        $ui->assertOk();
        $ui->assertDontSee('redirect');
    }
}
