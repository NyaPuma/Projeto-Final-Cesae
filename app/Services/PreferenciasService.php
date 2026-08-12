<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\UserPreference;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;

/**
 * Serviço central de preferências do utilizador.
 *
 * Geria preferências independentes de língua, moeda e formato de data.
 */
final class PreferenciasService
{
    /**
     * Chave da sessão para guardar preferências temporárias.
     */
    private const SESSION_KEY = 'user_preferences';

    /**
     * Valores predefinidos.
     */
    private const DEFAULTS = [
        'language' => 'pt',
        'currency' => 'EUR',
        'date_format' => 'd/m/Y',
    ];

    /**
     * Lista de moedas ISO 4217 suportadas.
     */
    private const SUPPORTED_CURRENCIES = [
        'EUR', 'USD', 'GBP', 'BRL', 'JPY', 'CNY', 'PLN',
        'ARS', 'CAD', 'MXN', 'INR', 'AED', 'KRW', 'ALL',
        'AZN', 'BAM', 'BGN', 'BYN', 'CHF', 'CZK', 'DKK',
        'GEL', 'HUF', 'ISK', 'MDL', 'MKD', 'RON', 'RSD',
        'RUB', 'SEK', 'TRY', 'UAH', 'AMD',
    ];

    /**
     * Lista de formatos de data suportados.
     */
    private const SUPPORTED_DATE_FORMATS = [
        'd/m/Y',    // 31/12/2024
        'm/d/Y',    // 12/31/2024
        'Y-m-d',    // 2024-12-31
        'd-m-Y',    // 31-12-2024
        'Y/m/d',    // 2024/12/31
        'd.m.Y',    // 31.12.2024
        'm-d-Y',    // 12-31-2024
    ];

    /**
     * Obtém as preferências do utilizador autenticado.
     */
    public static function forUser(Authenticatable $user): array
    {
        $prefs = UserPreference::where('user_id', $user->id)->first();

        if ($prefs) {
            return [
                'language' => $prefs->language,
                'currency' => $prefs->currency,
                'date_format' => $prefs->date_format,
            ];
        }

        return self::DEFAULTS;
    }

    /**
     * Obtém as preferências da sessão (para utilizadores não autenticados).
     */
    public static function fromSession(Request $request): array
    {
        $sessionPrefs = $request->session()->get(self::SESSION_KEY);

        if (is_array($sessionPrefs)) {
            return [
                'language' => $sessionPrefs['language'] ?? self::DEFAULTS['language'],
                'currency' => $sessionPrefs['currency'] ?? self::DEFAULTS['currency'],
                'date_format' => $sessionPrefs['date_format'] ?? self::DEFAULTS['date_format'],
            ];
        }

        return self::DEFAULTS;
    }

    /**
     * Obtém as preferências ativas (utilizador autenticado ou sessão).
     */
    public static function current(Request $request): array
    {
        $user = $request->user();

        if ($user) {
            return self::forUser($user);
        }

        return self::fromSession($request);
    }

    /**
     * Guarda preferências para o utilizador autenticado.
     */
    public static function saveForUser(Authenticatable $user, array $preferences): UserPreference
    {
        $validated = self::validatePreferences($preferences);

        return UserPreference::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );
    }

    /**
     * Guarda preferências na sessão (para utilizadores não autenticados).
     */
    public static function saveToSession(Request $request, array $preferences): void
    {
        $validated = self::validatePreferences($preferences);
        $request->session()->put(self::SESSION_KEY, $validated);
    }

    /**
     * Valida e normaliza as preferências.
     */
    private static function validatePreferences(array $preferences): array
    {
        return [
            'language' => self::validateLanguage($preferences['language'] ?? self::DEFAULTS['language']),
            'currency' => self::validateCurrency($preferences['currency'] ?? self::DEFAULTS['currency']),
            'date_format' => self::validateDateFormat($preferences['date_format'] ?? self::DEFAULTS['date_format']),
        ];
    }

    /**
     * Valida a língua.
     */
    public static function validateLanguage(string $language): string
    {
        if (LocaleService::isSupported($language)) {
            return $language;
        }

        return self::DEFAULTS['language'];
    }

    /**
     * Valida a moeda.
     */
    public static function validateCurrency(string $currency): string
    {
        $currency = strtoupper(trim($currency));

        if (in_array($currency, self::SUPPORTED_CURRENCIES, true)) {
            return $currency;
        }

        return self::DEFAULTS['currency'];
    }

    /**
     * Valida o formato de data.
     */
    public static function validateDateFormat(string $format): string
    {
        if (in_array($format, self::SUPPORTED_DATE_FORMATS, true)) {
            return $format;
        }

        return self::DEFAULTS['date_format'];
    }

    /**
     * Obtém a lista de moedas suportadas.
     */
    public static function supportedCurrencies(): array
    {
        return self::SUPPORTED_CURRENCIES;
    }

    /**
     * Obtém a lista de formatos de data suportados.
     */
    public static function supportedDateFormats(): array
    {
        return self::SUPPORTED_DATE_FORMATS;
    }

    /**
     * Obtém a moeda ativa para o utilizador.
     */
    public static function getCurrency(Request $request): string
    {
        return self::current($request)['currency'];
    }

    /**
     * Obtém o formato de data ativo para o utilizador.
     */
    public static function getDateFormat(Request $request): string
    {
        return self::current($request)['date_format'];
    }

    /**
     * Obtém a língua ativa para o utilizador.
     */
    public static function getLanguage(Request $request): string
    {
        return self::current($request)['language'];
    }
}
