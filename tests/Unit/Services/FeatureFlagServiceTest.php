<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\FeatureFlagService;
use Illuminate\Support\Facades\Cache;
use Tests\Base\UnitTestCase;

final class FeatureFlagServiceTest extends UnitTestCase
{
    private FeatureFlagService $service;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
        $this->service = new FeatureFlagService();
    }

    public function test_it_returns_config_default_when_no_cache_override(): void
    {
        // Arrange
        config(['features.flags.beta_dashboard' => true]);
        config(['features.flags.dark_mode' => false]);

        // Act & Assert
        $this->assertTrue($this->service->enabled('beta_dashboard'));
        $this->assertFalse($this->service->enabled('dark_mode'));
        $this->assertFalse($this->service->enabled('unknown_feature'));
        $this->assertTrue($this->service->enabled('unknown_feature', true));
    }

    public function test_it_can_enable_disable_and_clear_feature_flags(): void
    {
        // Arrange
        config(['features.flags.experimental_ai' => false]);

        // Act - Enable
        $this->service->enable('experimental_ai');
        $this->assertTrue($this->service->enabled('experimental_ai'));

        // Act - Disable
        $this->service->disable('experimental_ai');
        $this->assertFalse($this->service->enabled('experimental_ai'));

        // Act - Clear (falls back to config)
        $this->service->clear('experimental_ai');
        $this->assertFalse($this->service->enabled('experimental_ai'));
    }
}
