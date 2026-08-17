<?php

namespace Tests\Unit\Services;

use App\Services\LocaleService;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LocaleServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        app()->setLocale('pt-PT');
    }

    #[Test]
    public function currency_follows_the_active_locale(): void
    {
        app()->setLocale('pt-PT');
        $this->assertSame('EUR', LocaleService::currency());

        app()->setLocale('ar-AE');
        $this->assertSame('AED', LocaleService::currency());
    }

    #[Test]
    public function unit_system_follows_the_active_locale(): void
    {
        app()->setLocale('pt-PT');
        $this->assertSame('metric', LocaleService::unitSystem());

        app()->setLocale('en-US');
        $this->assertSame('imperial_us', LocaleService::unitSystem());

        app()->setLocale('en-GB');
        $this->assertSame('imperial_uk', LocaleService::unitSystem());
    }

    #[Test]
    public function format_number_keeps_the_significant_digits(): void
    {
        $this->assertStringContainsString('12', LocaleService::formatNumber(12.4));
        $this->assertStringContainsString('234', LocaleService::formatNumber(1234.56, 2));
        $this->assertEquals('1,234.56', LocaleService::formatNumber(1234.56, 2, 'en-US'));
    }

    #[Test]
    public function format_currency_keeps_the_amount_digits(): void
    {
        $this->assertStringContainsString('12', LocaleService::formatCurrency(12.5));
        $this->assertStringContainsString('0', LocaleService::formatCurrency(0));
    }

    #[Test]
    public function format_percent_treats_the_value_as_the_real_percentage(): void
    {
        $this->assertStringContainsString('55', LocaleService::formatPercent(55));
    }

    #[Test]
    public function format_date_and_datetime_handle_null_and_valid_input(): void
    {
        $this->assertSame('', LocaleService::formatDate(null));
        $this->assertSame('', LocaleService::formatDateTime(null));
        $this->assertSame('', LocaleService::formatDate('not-a-date'));

        $this->assertNotSame('', LocaleService::formatDate('2025-01-15'));
        $this->assertNotSame('', LocaleService::formatDateTime('2025-01-15 10:30:00'));
    }

    #[Test]
    public function format_accepts_datetime_instances(): void
    {
        $date = \DateTimeImmutable::createFromFormat('Y-m-d', '2025-06-01');

        $this->assertNotSame('', LocaleService::formatDate($date));
        $this->assertNotSame('', LocaleService::formatDateTime($date));
    }

    #[Test]
    public function convert_unit_converts_temperature_correctly(): void
    {
        app()->setLocale('en-US');
        $res = LocaleService::convertUnit(0, 'temperature', '°C');
        $this->assertSame('°F', $res['unit']);
        $this->assertEquals(32, $res['value']);

        app()->setLocale('pt-PT');
        $res = LocaleService::convertUnit(32, 'temperature', '°F');
        $this->assertSame('°C', $res['unit']);
        $this->assertEquals(0, $res['value']);
    }

    #[Test]
    public function convert_unit_converts_weight_and_distance(): void
    {
        app()->setLocale('en-US');
        $weight = LocaleService::convertUnit(10, 'weight', 'kg');
        $this->assertSame('lbs', $weight['unit']);
        $this->assertEquals(22.05, $weight['value']);

        $distance = LocaleService::convertUnit(10, 'distance', 'km');
        $this->assertSame('mi', $distance['unit']);
        $this->assertEquals(6.21, $distance['value']);
    }
}
