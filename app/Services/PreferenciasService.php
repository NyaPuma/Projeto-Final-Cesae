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
        'time_format' => 'H:i',
        'number_format' => '{"decimal":".","thousand":",","example":"1,234.56"}',
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
     * Lista de formatos de hora suportados.
     */
    private const SUPPORTED_TIME_FORMATS = [
        'H:i'     => ['label' => '24h', 'example' => '14:30'],
        'h:i A'   => ['label' => '12h', 'example' => '2:30 PM'],
        'H:i:s'   => ['label' => '24h + segundos', 'example' => '14:30:00'],
        'h:i:s A' => ['label' => '12h + segundos', 'example' => '2:30:00 PM'],
    ];

    /**
     * Lista de formatos de número suportados.
     * Cada formato é um array com: decimal_separator, thousand_separator
     */
    private const SUPPORTED_NUMBER_FORMATS = [
        // Europeu (Portugal, Espanha, França, Alemanha, etc.)
        'european' => ['decimal' => ',', 'thousand' => '.', 'example' => '1.234,56'],
        // Inglês (EUA, Reino Unido, Canadá inglês)
        'english' => ['decimal' => '.', 'thousand' => ',', 'example' => '1,234.56'],
        // Suíço (sem separador de milhar ou com apóstrofo)
        'swiss' => ['decimal' => '.', 'thousand' => "'", 'example' => "1'234.56"],
        // Espanhol (espaço como separador de milhar)
        'spanish' => ['decimal' => ',', 'thousand' => ' ', 'example' => '1 234,56'],
        //Índia
        'indian' => ['decimal' => '.', 'thousand' => ',', 'example' => '1,23,456.78'],
        // Chinês (sem separador de milhar)
        'chinese' => ['decimal' => '.', 'thousand' => '', 'example' => '1234.56'],
        // Japonês (sem separador de milhar)
        'japanese' => ['decimal' => '.', 'thousand' => '', 'example' => '1234.56'],
        // Sem separadores
        'none' => ['decimal' => '.', 'thousand' => '', 'example' => '1234.56'],
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
                'time_format' => $prefs->time_format ?? self::DEFAULTS['time_format'],
                'number_format' => $prefs->number_format ?? self::DEFAULTS['number_format'],
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
                'time_format' => $sessionPrefs['time_format'] ?? self::DEFAULTS['time_format'],
                'number_format' => $sessionPrefs['number_format'] ?? self::DEFAULTS['number_format'],
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
            'time_format' => self::validateTimeFormat($preferences['time_format'] ?? self::DEFAULTS['time_format']),
            'number_format' => self::validateNumberFormat($preferences['number_format'] ?? self::DEFAULTS['number_format']),
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
     * Valida o formato de hora.
     */
    public static function validateTimeFormat(string $format): string
    {
        if (array_key_exists($format, self::SUPPORTED_TIME_FORMATS)) {
            return $format;
        }

        return self::DEFAULTS['time_format'];
    }

    /**
     * Obtém a lista de formatos de hora suportados.
     */
    public static function supportedTimeFormats(): array
    {
        return self::SUPPORTED_TIME_FORMATS;
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
     * Lista de formatos de data suportados agrupados por símbolo separador.
     *
     * @return array<string, list<string>>
     */
    public static function groupedDateFormats(): array
    {
        $grouped = [];

        foreach (self::SUPPORTED_DATE_FORMATS as $format) {
            $separator = 'other';

            foreach (['/', '-', '.'] as $symbol) {
                if (str_contains($format, $symbol)) {
                    $separator = $symbol;
                    break;
                }
            }

            $grouped[$separator][] = $format;
        }

        return $grouped;
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
     * Obtém o formato de hora ativo para o utilizador.
     */
    public static function getTimeFormat(Request $request): string
    {
        return self::current($request)['time_format'] ?? self::DEFAULTS['time_format'];
    }

    /**
     * Obtém a língua ativa para o utilizador.
     */
    public static function getLanguage(Request $request): string
    {
        return self::current($request)['language'];
    }

    /**
     * Obtém o formato de número ativo para o utilizador.
     */
    public static function getNumberFormat(Request $request): string
    {
        return self::current($request)['number_format'] ?? self::DEFAULTS['number_format'];
    }

    /**
     * Obtém os separadores de número a partir do formato guardado.
     */
    public static function getNumberSeparators(Request $request): array
    {
        $format = self::getNumberFormat($request);
        $decoded = json_decode($format, true);
        
        if (is_array($decoded) && isset($decoded['decimal']) && isset($decoded['thousand'])) {
            return $decoded;
        }
        
        // Fallback para default
        return [
            'decimal' => '.',
            'thousand' => ',',
        ];
    }

    /**
     * Obtém a lista de formatos de número suportados.
     */
    public static function supportedNumberFormats(): array
    {
        return self::SUPPORTED_NUMBER_FORMATS;
    }

    /**
     * Lista de formatos de número suportados agrupados por separador decimal.
     *
     * @return array<string, array<string, array<string, string>>>
     */
    public static function groupedNumberFormats(): array
    {
        $grouped = [];

        foreach (self::SUPPORTED_NUMBER_FORMATS as $key => $format) {
            $decimal = $format['decimal'] ?? 'other';
            $grouped[$decimal][$key] = $format;
        }

        return $grouped;
    }

    /**
     * Formata um número de acordo com as preferências do utilizador.
     */
    public static function formatNumber(Request $request, float $number): string
    {
        $separators = self::getNumberSeparators($request);
        
        return number_format(
            $number,
            2,
            $separators['decimal'],
            $separators['thousand']
        );
    }

    /**
     * Valida o formato de número.
     */
    public static function validateNumberFormat(string $format): string
    {
        $decoded = json_decode($format, true);
        
        if (is_array($decoded) && isset($decoded['decimal']) && isset($decoded['thousand'])) {
            return $format;
        }
        
        return self::DEFAULTS['number_format'];
    }
}
