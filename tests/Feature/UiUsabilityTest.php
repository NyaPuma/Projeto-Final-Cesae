<?php

namespace Tests\Feature;

use Tests\TestCase;

class UiUsabilityTest extends TestCase
{
    public function test_homepage_renders_core_operational_sections(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSeeText('Centro de Controlo');
        $response->assertSeeText('Tickets');
        $response->assertSeeText('Equipamentos');
        $response->assertSeeText('Analytics');
        $response->assertSeeText('Swagger');
        $response->assertSee('Skip to content', false);
        $response->assertSee('role="main"', false);
    }

    public function test_login_page_exposes_accessible_authentication_form(): void
    {
        $response = $this->get('/ui/login');

        $response->assertOk();
        $response->assertSeeText('Iniciar Sessão');
        $response->assertSeeText('Criar Conta');
        $response->assertSee('name="email"', false);
        $response->assertSee('name="password"', false);
        $response->assertSee('aria-live="polite"', false);
        $response->assertSee('Skip to content', false);
        $response->assertSee('role="main"', false);
    }

    public function test_protected_ui_pages_redirect_unauthenticated_users_to_login(): void
    {
        $this->get('/ui')->assertRedirect('/ui/login');
        $this->get('/ui/tickets')->assertRedirect('/ui/login');
        $this->get('/ui/analytics')->assertRedirect('/ui/login');
        $this->get('/ui/profile')->assertRedirect('/ui/login');
    }
}
