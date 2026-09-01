<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\Base\FeatureTestCase;

final class SystemSettingsFeatureTest extends FeatureTestCase
{
    public function test_regular_user_cannot_access_system_settings(): void
    {
        // Arrange
        $user = $this->createRegularUser();

        // Act
        $response = $this->withHeader('X-Auth-Token', $user->api_token)
            ->actingAs($user)
            ->get('/ui/settings/system');

        // Assert
        $response->assertStatus(302);
    }

    public function test_admin_can_view_system_settings_page(): void
    {
        // Arrange
        $admin = $this->createAdmin();

        // Act
        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->get('/ui/settings/system');

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('ui.settings.system');
        $response->assertViewHas('groups');
        $response->assertViewHas('values');
    }

    public function test_admin_can_update_system_settings(): void
    {
        // Arrange
        $admin = $this->createAdmin();

        // Act
        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->postJson('/ui/settings/system', [
                'updates' => [
                    'app.name' => 'Gestor de Avarias Novo',
                ],
            ]);

        // Assert
        $response->assertStatus(200)
            ->assertJson([
                'ok' => true,
                'values' => [
                    'app.name' => 'Gestor de Avarias Novo',
                ],
            ]);

        $this->assertDatabaseHas('system_settings', [
            'key' => 'app.name',
            'value' => 'Gestor de Avarias Novo',
        ]);
    }

    public function test_admin_can_reset_system_settings_group(): void
    {
        // Arrange
        $admin = $this->createAdmin();

        // Act
        $response = $this->withHeader('X-Auth-Token', $admin->api_token)
            ->actingAs($admin)
            ->postJson('/ui/settings/system', [
                'reset' => 'app',
            ]);

        // Assert
        $response->assertStatus(200)
            ->assertJsonPath('ok', true)
            ->assertJsonPath('reset', 'app');
    }
}
