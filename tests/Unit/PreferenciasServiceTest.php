<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Services\PreferenciasService;
use PHPUnit\Framework\TestCase;

/**
 * Testes unitários para o PreferenciasService.
 * 
 * Testa a validação e normalização de preferências independentemente.
 */
class PreferenciasServiceTest extends TestCase
{
    /** @test */
    public function it_returns_supported_currencies_list(): void
    {
        $currencies = PreferenciasService::supportedCurrencies();

        $this->assertIsArray($currencies);
        $this->assertContains('EUR', $currencies);
        $this->assertContains('USD', $currencies);
        $this->assertContains('GBP', $currencies);
    }

    /** @test */
    public function it_returns_supported_date_formats_list(): void
    {
        $formats = PreferenciasService::supportedDateFormats();

        $this->assertIsArray($formats);
        $this->assertContains('d/m/Y', $formats);
        $this->assertContains('m/d/Y', $formats);
        $this->assertContains('Y-m-d', $formats);
    }

    /** @test */
    public function it_normalizes_currency_to_uppercase(): void
    {
        $prefs = PreferenciasService::validatePreferences([
            'language' => 'pt',
            'currency' => 'eur', // minúsculas
            'date_format' => 'd/m/Y',
        ]);

        $this->assertEquals('EUR', $prefs['currency']);
    }

    /** @test */
    public function it_trims_currency_whitespace(): void
    {
        $prefs = PreferenciasService::validatePreferences([
            'language' => 'pt',
            'currency' => ' EUR ',
            'date_format' => 'd/m/Y',
        ]);

        $this->assertEquals('EUR', $prefs['currency']);
    }

    /** @test */
    public function it_uses_default_language_for_invalid(): void
    {
        $prefs = PreferenciasService::validatePreferences([
            'language' => 'invalid-locale',
            'currency' => 'EUR',
            'date_format' => 'd/m/Y',
        ]);

        $this->assertEquals('pt', $prefs['language']);
    }

    /** @test */
    public function it_uses_default_currency_for_invalid(): void
    {
        $prefs = PreferenciasService::validatePreferences([
            'language' => 'pt',
            'currency' => 'XXX',
            'date_format' => 'd/m/Y',
        ]);

        $this->assertEquals('EUR', $prefs['currency']);
    }

    /** @test */
    public function it_uses_default_date_format_for_invalid(): void
    {
        $prefs = PreferenciasService::validatePreferences([
            'language' => 'pt',
            'currency' => 'EUR',
            'date_format' => 'invalid-format',
        ]);

        $this->assertEquals('d/m/Y', $prefs['date_format']);
    }

    /** @test */
    public function it_accepts_all_supported_currencies(): void
    {
        $supported = PreferenciasService::supportedCurrencies();

        foreach ($supported as $currency) {
            $prefs = PreferenciasService::validatePreferences([
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
        $supported = PreferenciasService::supportedDateFormats();

        foreach ($supported as $format) {
            $prefs = PreferenciasService::validatePreferences([
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
        // Testar os defaults directly
        $prefs = PreferenciasService::validatePreferences([
            'language' => null,
            'currency' => null,
            'date_format' => null,
        ]);

        $this->assertEquals('pt', $prefs['language']);
        $this->assertEquals('EUR', $prefs['currency']);
        $this->assertEquals('d/m/Y', $prefs['date_format']);
    }

    /** @test */
    public function it_handles_empty_array(): void
    {
        $prefs = PreferenciasService::validatePreferences([]);

        $this->assertEquals('pt', $prefs['language']);
        $this->assertEquals('EUR', $prefs['currency']);
        $this->assertEquals('d/m/Y', $prefs['date_format']);
    }

    /** @test */
    public function it_preserves_valid_preferences(): void
    {
        $prefs = PreferenciasService::validatePreferences([
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
        $currencies = PreferenciasService::supportedCurrencies();

        // Verificar que todas são strings de 3 caracteres
        foreach ($currencies as $currency) {
            $this->assertIsString($currency);
            $this->assertEquals(3, strlen($currency));
        }
    }
}
