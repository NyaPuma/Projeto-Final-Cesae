<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Models\SystemSetting;
use App\Services\SystemSettingsService;
use Tests\Base\DatabaseTestCase;

final class SystemSettingsServiceTest extends DatabaseTestCase
{
    private SystemSettingsService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new SystemSettingsService;
    }

    public function test_groups_returns_curated_configuration_structure(): void
    {
        // Act
        $groups = $this->service->groups();

        // Assert
        $this->assertArrayHasKey('app', $groups);
        $this->assertArrayHasKey('auth', $groups);
        $this->assertArrayHasKey('budget', $groups);
        $this->assertArrayHasKey('ai', $groups);
        $this->assertArrayHasKey('pagination', $groups);
    }

    public function test_update_saves_values_in_database_and_config(): void
    {
        // Arrange
        $updates = [
            'app.name' => 'Sistema CESAE Avarias',
            'services.custom.auth.max_attempts' => 10,
            'services.custom.budget.threshold' => 150.50,
        ];

        // Act
        $result = $this->service->update($updates);

        // Assert
        $this->assertSame('Sistema CESAE Avarias', $result['app.name']);
        $this->assertSame(10, $result['services.custom.auth.max_attempts']);
        $this->assertSame(150.5, $result['services.custom.budget.threshold']);

        $this->assertDatabaseHas('system_settings', [
            'key' => 'app.name',
            'value' => 'Sistema CESAE Avarias',
        ]);
        $this->assertSame('Sistema CESAE Avarias', config('app.name'));
    }

    public function test_reset_removes_group_overrides_from_database(): void
    {
        // Arrange
        $this->service->update(['app.name' => 'Custom Name']);
        $this->assertDatabaseHas('system_settings', ['key' => 'app.name']);

        // Act
        $this->service->reset('app');

        // Assert
        $this->assertDatabaseMissing('system_settings', ['key' => 'app.name']);
    }

    public function test_apply_overrides_loads_db_values_into_config(): void
    {
        // Arrange
        SystemSetting::create(['key' => 'app.name', 'value' => 'Overridden Name']);

        // Act
        $this->service->applyOverrides();

        // Assert
        $this->assertSame('Overridden Name', config('app.name'));
    }
}
