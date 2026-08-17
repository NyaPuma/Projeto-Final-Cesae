<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Services\LocalizationService;
use Carbon\Carbon;
use Tests\TestCase;

final class LocalizationServiceTest extends TestCase
{
    public function test_formats_number_and_currency_using_the_active_locale(): void
    {
        app()->setLocale('pt-PT');
        $service = app(LocalizationService::class);

        $this->assertStringContainsString('1', str_replace("\u{00A0}", ' ', $service->formatNumber(1234)));
        $this->assertStringContainsString('€', $service->formatCurrency(1234.5));
    }

    public function test_formats_dates_and_handles_empty_values(): void
    {
        $service = app(LocalizationService::class);
        $date = Carbon::create(2025, 1, 15, 10, 30, 0, 'UTC');

        app()->setLocale('en-US');
        $this->assertNotSame('', $service->formatDate($date));
        $this->assertNotSame('', $service->formatDateTime($date));
        $this->assertSame('', $service->formatDate(null));
    }

    public function test_converts_units_for_the_selected_region(): void
    {
        $service = app(LocalizationService::class);
        $converted = $service->convertUnit(10, 'distance', 'km', 'en-US');

        $this->assertSame('mi', $converted['unit']);
        $this->assertSame(6.21, $converted['value']);
    }
}
