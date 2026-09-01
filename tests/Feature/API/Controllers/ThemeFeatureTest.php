<?php

declare(strict_types=1);

namespace Tests\Feature\API\Controllers;

use Tests\Base\FeatureTestCase;

final class ThemeFeatureTest extends FeatureTestCase
{
    public function test_custom_css_endpoint_returns_css_stylesheet(): void
    {
        // Act
        $response = $this->get('/theme/custom.css');

        // Assert
        $response->assertStatus(200);
        $response->assertHeader('content-type', 'text/css; charset=utf-8');
        $this->assertStringContainsString(':root', $response->getContent());
        $this->assertStringContainsString('--color-primary', $response->getContent());
    }

    public function test_authenticated_user_can_switch_theme(): void
    {
        // Arrange
        $user = $this->createRegularUser();

        // Act
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->actingAs($user)
            ->postJson('/theme/switch', [
                'theme' => 'escuro-azul',
            ]);

        // Assert
        $response->assertStatus(200)
            ->assertJsonPath('ok', true)
            ->assertJsonPath('theme', 'escuro-azul')
            ->assertJsonPath('mode', 'dark');

        $this->assertSame('escuro-azul', $user->fresh()->theme);
    }

    public function test_switch_theme_rejects_invalid_theme_name(): void
    {
        // Arrange
        $user = $this->createRegularUser();

        // Act
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->actingAs($user)
            ->postJson('/theme/switch', [
                'theme' => 'invalid-theme-xyz',
            ]);

        // Assert
        $response->assertStatus(422)
            ->assertJsonValidationErrors(['theme']);
    }
}
