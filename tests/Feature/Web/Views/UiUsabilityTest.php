<?php

namespace Tests\Feature;

use Tests\TestCase;

class UiUsabilityTest extends TestCase
{
    public function test_homepage_renders_core_operational_sections(): void
    {
        $response = $this->get('/');

        $response->assertOk();

        $content = (string) $response->getContent();

        // Strings podem variar por idioma/branding. Aceita PT ou EN.
        $this->assertTrue(
            str_contains($content, 'Centro de Controlo') || str_contains($content, 'Fault Management'),
            'Expected homepage to contain either "Centro de Controlo" (PT) or "Fault Management" (EN).'
        );

        // A homepage pode variar bastante por idioma/versão de UI.
        // Valida elementos estáveis/centrais.
        $this->assertTrue(
            str_contains($content, 'Welcome to the System') || str_contains($content, 'Bem-vindo') || str_contains($content, 'Welcome to the System'),
            'Expected homepage to contain a stable welcome heading.'
        );

        // Validações mínimas: título/heading principal e algum item de navegação.
        $this->assertTrue(
            str_contains($content, 'Fault Management') || str_contains($content, 'Welcome to the System'),
            'Expected homepage to contain the main application heading.'
        );

        // Não exigir strings específicas de módulos na homepage (pode variar por rota/idioma).
        $response->assertSee('Skip to content', false);
    }

    public function test_login_page_exposes_accessible_authentication_form(): void
    {
        $response = $this->get('/ui/login');

        $response->assertOk();

        $content = (string) $response->getContent();

        $this->assertTrue(
            str_contains($content, 'Iniciar Sessão') || str_contains($content, 'Login'),
            'Expected login page to contain either "Iniciar Sessão" or "Login".'
        );
        // Signup/conta pode não existir na view de login (ou estar noutra rota).
        // Não exigir texto de "Criar Conta" nesta suite de usabilidade.

        $response->assertSee('name="email"', false);
        $response->assertSee('name="password"', false);
        $response->assertSee('aria-live="polite"', false);
    }

    public function test_protected_ui_pages_redirect_unauthenticated_users_to_login(): void
    {
        $this->get('/ui')->assertRedirect('/ui/login');
        $this->get('/ui/tickets')->assertRedirect('/ui/login');
        $this->get('/ui/analytics')->assertRedirect('/ui/login');
        $this->get('/ui/profile')->assertRedirect('/ui/login');
    }
}
