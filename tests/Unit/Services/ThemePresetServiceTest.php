<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\ThemePresetService;
use Tests\Base\DatabaseTestCase;

final class ThemePresetServiceTest extends DatabaseTestCase
{
    private ThemePresetService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ThemePresetService();
    }

    public function test_all_returns_preset_themes_with_required_fields(): void
    {
        // Act
        $themes = $this->service->all();

        // Assert
        $this->assertNotEmpty($themes);
        $this->assertArrayHasKey(ThemePresetService::DEFAULT_THEME, $themes);

        foreach ($themes as $id => $theme) {
            $this->assertArrayHasKey('label', $theme);
            $this->assertArrayHasKey('mode', $theme);
            $this->assertArrayHasKey('family', $theme);
            $this->assertArrayHasKey('primary', $theme);
            $this->assertContains($theme['mode'], ['light', 'dark']);
        }
    }

    public function test_find_returns_theme_with_id_or_null(): void
    {
        // Act & Assert
        $theme = $this->service->find('claro-azul');
        $this->assertNotNull($theme);
        $this->assertSame('claro-azul', $theme['id']);
        $this->assertSame('light', $theme['mode']);

        $this->assertNull($this->service->find('nonexistent-theme'));
    }

    public function test_paired_returns_opposite_mode_in_same_family(): void
    {
        // Act
        $paired = $this->service->paired('claro-laranja');

        // Assert
        $this->assertNotNull($paired);
        $this->assertSame('escuro-laranja', $paired['id']);
        $this->assertSame('dark', $paired['mode']);
        $this->assertSame('laranja', $paired['family']);
    }

    public function test_effective_theme_id_falls_back_to_default_for_null_or_invalid(): void
    {
        // Act & Assert
        $this->assertSame('claro-verde', $this->service->effectiveThemeId('claro-verde'));
        $this->assertSame(ThemePresetService::DEFAULT_THEME, $this->service->effectiveThemeId(null));
        $this->assertSame(ThemePresetService::DEFAULT_THEME, $this->service->effectiveThemeId('invalid-theme'));
    }

    public function test_values_for_maps_preset_to_css_tokens(): void
    {
        // Act
        $values = $this->service->valuesFor('claro-laranja');

        // Assert
        $this->assertNotEmpty($values);
        $this->assertArrayHasKey('--color-primary', $values);
        $this->assertArrayHasKey('--color-surface', $values);
        $this->assertSame('#ea580c', $values['--color-primary']);
    }

    public function test_apply_for_user_updates_user_theme(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $applied = $this->service->applyForUser($user, 'escuro-azul');

        // Assert
        $this->assertSame('escuro-azul', $applied['id']);
        $this->assertSame('escuro-azul', $user->fresh()->theme);
    }
}
