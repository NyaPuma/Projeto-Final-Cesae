<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Services\PreferencesService;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for PreferencesService.
 *
 * Tests validation and normalization of preferences independently.
 */
class PreferenciasServiceTest extends TestCase
{
    /** @test */
    public function it_returns_supported_currencies_list(): void
    {
        $currencies = PreferencesService::supportedCurrencies();

        $this->assertIsArray($currencies);
        $this->assertContains('EUR', $currencies);
        $this->assertContains('USD', $currencies);
        $this->assertContains('GBP', $currencies);
    }

    /** @test */
    public function it_returns_supported_date_formats_list(): void
    {
        $formats = PreferencesService::supportedDateFormats();

        $this->assertIsArray($formats);
        $this->assertContains('d/m/Y', $formats);
        $this->assertContains('m/d/Y', $formats);
        $this->assertContains('Y-m-d', $formats);
    }

    /** @test */
    public function it_normalizes_currency_to_uppercase(): void
    {
        $prefs = PreferencesService::validatePreferences([
            'language' => 'pt',
            'currency' => 'eur', // lowercase
            'date_format' => 'd/m/Y',
        ]);

        $this->assertEquals('EUR', $prefs['currency']);
    }

    /** @test */
    public function it_trims_currency_whitespace(): void
    {
        $prefs = PreferencesService::validatePreferences([
            'language' => 'pt',
            'currency' => ' EUR ',
            'date_format' => 'd/m/Y',
        ]);

        $this->assertEquals('EUR', $prefs['currency']);
    }

    /** @test */
    public function it_uses_default_language_for_invalid(): void
    {
        $prefs = PreferencesService::validatePreferences([
            'language' => 'invalid-locale',
            'currency' => 'EUR',
            'date_format' => 'd/m/Y',
        ]);

        $this->assertEquals('pt-PT', $prefs['language']);
    }

    /** @test */
    public function it_uses_default_currency_for_invalid(): void
    {
        $prefs = PreferencesService::validatePreferences([
            'language' => 'pt',
            'currency' => 'XXX',
            'date_format' => 'd/m/Y',
        ]);

        $this->assertEquals('EUR', $prefs['currency']);
    }

    /** @test */
    public function it_uses_default_date_format_for_invalid(): void
    {
        $prefs = PreferencesService::validatePreferences([
            'language' => 'pt',
            'currency' => 'EUR',
            'date_format' => 'invalid-format',
        ]);

        $this->assertEquals('d/m/Y', $prefs['date_format']);
    }

    /** @test */
    public function it_accepts_all_supported_currencies(): void
    {
        $supported = PreferencesService::supportedCurrencies();

        foreach ($supported as $currency) {
            $prefs = PreferencesService::validatePreferences([
                'language' => 'pt',
                'currency' => $currency,
                'date_format' => 'd/m/Y',
            ]);

            $this->assertEquals($currency, $prefs['currency']);
        }
    }

    /** @test */
    public function it_accepts_all_supported_date_formats(): void
    {
        $supported = PreferencesService::supportedDateFormats();

        foreach ($supported as $format) {
            $prefs = PreferencesService::validatePreferences([
                'language' => 'pt',
                'currency' => 'EUR',
                'date_format' => $format,
            ]);

            $this->assertEquals($format, $prefs['date_format']);
        }
    }

    /** @test */
    public function it_has_correct_defaults(): void
    {
        // Test defaults directly
        $prefs = PreferencesService::validatePreferences([
            'language' => null,
            'currency' => null,
            'date_format' => null,
        ]);

        $this->assertEquals('pt-PT', $prefs['language']);
        $this->assertEquals('EUR', $prefs['currency']);
        $this->assertEquals('d/m/Y', $prefs['date_format']);
    }

    /** @test */
    public function it_handles_empty_array(): void
    {
        $prefs = PreferencesService::validatePreferences([]);

        $this->assertEquals('pt-PT', $prefs['language']);
        $this->assertEquals('EUR', $prefs['currency']);
        $this->assertEquals('d/m/Y', $prefs['date_format']);
    }

    /** @test */
    public function it_preserves_valid_preferences(): void
    {
        $prefs = PreferencesService::validatePreferences([
            'language' => 'en-GB',
            'currency' => 'USD',
            'date_format' => 'm/d/Y',
        ]);

        $this->assertEquals('en-GB', $prefs['language']);
        $this->assertEquals('USD', $prefs['currency']);
        $this->assertEquals('m/d/Y', $prefs['date_format']);
    }

    /** @test */
    public function it_returns_only_supported_currencies(): void
    {
        $currencies = PreferencesService::supportedCurrencies();

        // Verify all are 3-character strings
        foreach ($currencies as $currency) {
            $this->assertIsString($currency);
            $this->assertEquals(3, strlen($currency));
        }
    }
}
