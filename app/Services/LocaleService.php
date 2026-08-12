<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Http\Request;

/**
 * Serviço central de locais (idiomas/regiões).
 *
 * Centraliza o acesso a `config('locales')` — a fonte única de verdade — e
 * fornece a resolução de preferência do utilizador a partir do request.
 */
final class LocaleService
{
    /**
     * Locais agrupados por continente, na ordem definida em config.
     *
     * @return array<string, array<string, array<string, mixed>>>
     */
    public static function grouped(): array
    {
        $locales = config('locales', []);

        return is_array($locales)
            ? array_filter($locales, fn ($v) => is_array($v))
            : [];
    }

    /**
     * Lista plana de todos os locais (código => metadata).
     *
     * @return array<string, array<string, mixed>>
     */
    public static function all(): array
    {
        $flattened = [];

        foreach (self::grouped() as $group) {
            foreach ($group as $code => $meta) {
                $flattened[$code] = $meta;
            }
        }

        return $flattened;
    }

    /**
     * Códigos de todos os locais suportados.
     *
     * @return list<string>
     */
    public static function codes(): array
    {
        return array_keys(self::all());
    }

    /**
     * Locale predefinido do sistema.
     *
     * Preferência: override de `app.locale` (definições na BD) → `locales.default`
     * (env) → 'pt-PT'. Devolve sempre um código suportado.
     */
    public static function default(): string
    {
        $candidates = [
            config('app.locale'),
            config('locales.default'),
            'pt-PT',
        ];

        foreach ($candidates as $candidate) {
            if (is_string($candidate) && self::isSupported($candidate)) {
                return $candidate;
            }
        }

        return 'pt-PT';
    }

    /**
     * Verifica se um código é um locale suportado.
     */
    public static function isSupported(string $locale): bool
    {
        return array_key_exists($locale, self::all());
    }

    /**
     * Metadata de um locale (null se não suportado).
     *
     * @return array<string, mixed>|null
     */
    public static function meta(string $locale): ?array
    {
        return self::all()[$locale] ?? null;
    }

    /**
     * Designação fiscal usada na região do locale ativo.
     */
    public static function taxIdentifierLabel(?string $locale = null): string
    {
        $code = $locale ?? app()->getLocale();

        return match ($code) {
            'pt-PT' => 'NIF',
            'pt-BR' => 'CNPJ',
            'en-GB' => 'UTR',
            'en-US' => 'EIN',
            'es-ES' => 'NIF',
            'es-MX' => 'RFC',
            'es-AR' => 'CUIT',
            'fr-FR' => 'SIRET',
            'fr-CA' => 'BN',
            'de-DE' => 'Steuernummer',
            'it-IT' => 'Partita IVA',
            'nl-NL' => 'BTW-nummer',
            'pl-PL' => 'NIP',
            'zh-CN' => 'USCC',
            'ja-JP' => 'Corporate Number',
            'ko-KR' => 'BRN',
            'hi-IN' => 'GSTIN',
            'ar-AE' => 'TRN',
            default => 'Tax ID',
        };
    }

    /**
     * Designação local do imposto sobre o consumo equivalente ao IVA/VAT.
     */
    public static function indirectTaxLabel(?string $locale = null): string
    {
        $code = $locale ?? app()->getLocale();

        return match ($code) {
            'pt-PT', 'pt-BR' => 'IVA',
            'en-GB', 'en-US', 'ar-AE' => 'VAT',
            'es-ES', 'es-MX', 'es-AR' => 'IVA',
            'fr-FR', 'fr-CA' => 'TVA',
            'de-DE' => 'MwSt.',
            'it-IT' => 'IVA',
            'nl-NL' => 'btw',
            'pl-PL' => 'VAT',
            'zh-CN' => '增值税',
            'ja-JP' => '消費税',
            'ko-KR' => '부가가치세',
            'hi-IN' => 'GST',
            default => 'VAT',
        };
    }

    /**
     * Devolve a bandeira Unicode correspondente ao código ISO-3166 alpha-2.
     * Mantém o seletor funcional sem depender de CDN ou imagens externas.
     */
    public static function flagEmoji(?string $countryCode): string
    {
        $code = strtoupper(trim((string) $countryCode));

        if (!preg_match('/^[A-Z]{2}$/', $code)) {
            return '🏳️';
        }

        return implode('', array_map(
            static fn (string $letter): string => mb_chr(127397 + ord($letter)),
            str_split($code),
        ));
    }

    /**
     * Indica se o locale é right-to-left.
     */
    public static function isRtl(string $locale): bool
    {
        return (bool) (self::meta($locale)['rtl'] ?? false);
    }

    /**
     * Moeda ISO 4217 do locale indicado (ou atual).
     */
    public static function currency(?string $locale = null): string
    {
        $targetLocale = $locale ?? app()->getLocale();

        return (string) (self::meta($targetLocale)['currency'] ?? 'EUR');
    }

    /**
     * Sistema de unidades do locale indicado (ou atual).
     */
    public static function unitSystem(?string $locale = null): string
    {
        $targetLocale = $locale ?? app()->getLocale();

        return (string) (self::meta($targetLocale)['unit_system'] ?? 'metric');
    }

    /**
     * Formata um número segundo o locale indicado (ou atual).
     */
    public static function formatNumber(int|float $value, int $decimals = 0, ?string $locale = null): string
    {
        $targetLocale = $locale ?? app()->getLocale();

        if (class_exists(\NumberFormatter::class)) {
            $formatter = new \NumberFormatter($targetLocale, \NumberFormatter::DECIMAL);
            $formatter->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, $decimals);
            $formatter->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, $decimals);

            $result = $formatter->format($value);
            if ($result !== false) {
                return $result;
            }
        }

        $decPoint = in_array($targetLocale, ['en-US', 'en-GB'], true) ? '.' : ',';
        $thousandsSep = in_array($targetLocale, ['en-US', 'en-GB'], true) ? ',' : ' ';

        return number_format((float) $value, $decimals, $decPoint, $thousandsSep);
    }

    /**
     * Formata um montante na moeda do locale indicado (ou atual).
     */
    public static function formatCurrency(int|float $value, ?string $currency = null, ?string $locale = null): string
    {
        $targetLocale = $locale ?? app()->getLocale();
        $currencyCode = $currency ?? self::currency($targetLocale);

        if (class_exists(\NumberFormatter::class)) {
            $formatter = new \NumberFormatter($targetLocale, \NumberFormatter::CURRENCY);
            $result = $formatter->formatCurrency($value, $currencyCode);
            if ($result !== false) {
                return $result;
            }
        }

        $formattedNum = self::formatNumber($value, 2, $targetLocale);
        $symbols = [
            'EUR' => '€',
            'GBP' => '£',
            'USD' => '$',
            'BRL' => 'R$',
            'JPY' => '¥',
            'CNY' => '¥',
            'PLN' => 'zł',
            'ARS' => '$',
            'CAD' => 'CA$',
            'MXN' => 'MX$',
            'INR' => '₹',
            'AED' => 'AED',
            'KRW' => '₩',
            'ALL' => 'L',
            'AZN' => '₼',
            'BAM' => 'KM',
            'BGN' => 'лв',
            'BYN' => 'Br',
            'CHF' => 'Fr',
            'CZK' => 'Kč',
            'DKK' => 'kr',
            'GEL' => '₾',
            'HUF' => 'Ft',
            'ISK' => 'kr',
            'MDL' => 'L',
            'MKD' => 'ден',
            'RON' => 'lei',
            'RSD' => 'дин',
            'RUB' => '₽',
            'SEK' => 'kr',
            'TRY' => '₺',
            'UAH' => '₴',
            'AMD' => '֏',
        ];

        $symbol = $symbols[$currencyCode] ?? $currencyCode;

        if (in_array($targetLocale, ['en-US', 'en-GB', 'fr-CA'], true)) {
            return "{$symbol}{$formattedNum}";
        }

        return "{$formattedNum} {$symbol}";
    }

    /**
     * Formata uma percentagem — o valor é a percentagem real (55 = "55%").
     */
    public static function formatPercent(int|float $value, int $decimals = 1, ?string $locale = null): string
    {
        $targetLocale = $locale ?? app()->getLocale();

        if (class_exists(\NumberFormatter::class)) {
            $formatter = new \NumberFormatter($targetLocale, \NumberFormatter::PERCENT);
            $formatter->setAttribute(\NumberFormatter::MIN_FRACTION_DIGITS, $decimals);
            $formatter->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, $decimals);

            $result = $formatter->format($value / 100);
            if ($result !== false) {
                return $result;
            }
        }

        $formattedNum = self::formatNumber($value, $decimals, $targetLocale);

        return "{$formattedNum}%";
    }

    /**
     * Formata uma data (curta) segundo o locale indicado (ou atual).
     */
    public static function formatDate(mixed $value, ?string $locale = null): string
    {
        $date = self::asDateTime($value);

        if ($date === null) {
            return '';
        }

        $targetLocale = $locale ?? app()->getLocale();

        if (class_exists(\IntlDateFormatter::class)) {
            $formatter = \IntlDateFormatter::create(
                $targetLocale,
                \IntlDateFormatter::SHORT,
                \IntlDateFormatter::NONE,
            );

            if ($formatter) {
                $result = $formatter->format($date);
                if ($result !== false) {
                    return $result;
                }
            }
        }

        return $date->format('d/m/Y');
    }

    /**
     * Formata data e hora segundo o locale indicado (ou atual).
     */
    public static function formatDateTime(mixed $value, ?string $locale = null): string
    {
        $date = self::asDateTime($value);

        if ($date === null) {
            return '';
        }

        $targetLocale = $locale ?? app()->getLocale();

        if (class_exists(\IntlDateFormatter::class)) {
            $formatter = \IntlDateFormatter::create(
                $targetLocale,
                \IntlDateFormatter::SHORT,
                \IntlDateFormatter::SHORT,
            );

            if ($formatter) {
                $result = $formatter->format($date);
                if ($result !== false) {
                    return $result;
                }
            }
        }

        return $date->format('d/m/Y H:i');
    }

    /**
     * Converte uma unidade de medida com base no sistema de unidades do locale.
     *
     * Tipos suportados: 'temperature', 'distance', 'weight', 'volume'.
     *
     * @return array{value: float, unit: string, formatted: string}
     */
    public static function convertUnit(float|int $value, string $type, string $fromUnit = '', ?string $locale = null): array
    {
        $numValue = (float) $value;
        $unitSys = self::unitSystem($locale);

        switch (strtolower($type)) {
            case 'temperature':
                $isImperial = ($unitSys === 'imperial_us');
                if ($isImperial && in_array(strtolower($fromUnit), ['c', 'celsius', '°c', ''], true)) {
                    $converted = ($numValue * 9 / 5) + 32;
                    $unit = '°F';
                } elseif (! $isImperial && in_array(strtolower($fromUnit), ['f', 'fahrenheit', '°f'], true)) {
                    $converted = ($numValue - 32) * 5 / 9;
                    $unit = '°C';
                } else {
                    $converted = $numValue;
                    $unit = in_array(strtolower($fromUnit), ['f', 'fahrenheit', '°f'], true) ? '°F' : '°C';
                }
                break;

            case 'distance':
            case 'length':
                $isImperial = in_array($unitSys, ['imperial_uk', 'imperial_us'], true);
                $from = strtolower($fromUnit);

                if ($isImperial && in_array($from, ['km', 'kilometres', 'quilómetros'], true)) {
                    $converted = $numValue * 0.621371;
                    $unit = 'mi';
                } elseif ($isImperial && in_array($from, ['m', 'meters', 'metros', ''], true)) {
                    $converted = $numValue * 3.28084;
                    $unit = 'ft';
                } elseif (! $isImperial && in_array($from, ['mi', 'miles', 'milhas'], true)) {
                    $converted = $numValue / 0.621371;
                    $unit = 'km';
                } elseif (! $isImperial && in_array($from, ['ft', 'feet', 'pés'], true)) {
                    $converted = $numValue / 3.28084;
                    $unit = 'm';
                } else {
                    $converted = $numValue;
                    $unit = $fromUnit !== '' ? $fromUnit : ($isImperial ? 'ft' : 'm');
                }
                break;

            case 'weight':
                $isImperial = in_array($unitSys, ['imperial_uk', 'imperial_us'], true);
                $from = strtolower($fromUnit);

                if ($isImperial && in_array($from, ['kg', 'kilos', 'quilogramas', ''], true)) {
                    $converted = $numValue * 2.20462;
                    $unit = 'lbs';
                } elseif (! $isImperial && in_array($from, ['lbs', 'lb', 'libras'], true)) {
                    $converted = $numValue / 2.20462;
                    $unit = 'kg';
                } else {
                    $converted = $numValue;
                    $unit = $fromUnit !== '' ? $fromUnit : ($isImperial ? 'lbs' : 'kg');
                }
                break;

            case 'volume':
                $isUsImperial = ($unitSys === 'imperial_us');
                $from = strtolower($fromUnit);

                if ($isUsImperial && in_array($from, ['l', 'liter', 'litro', 'litros', ''], true)) {
                    $converted = $numValue * 0.264172;
                    $unit = 'gal';
                } elseif (! $isUsImperial && in_array($from, ['gal', 'gallon', 'galão', 'galões'], true)) {
                    $converted = $numValue / 0.264172;
                    $unit = 'L';
                } else {
                    $converted = $numValue;
                    $unit = $fromUnit !== '' ? $fromUnit : ($isUsImperial ? 'gal' : 'L');
                }
                break;

            default:
                $converted = $numValue;
                $unit = $fromUnit;
                break;
        }

        $formattedNum = self::formatNumber($converted, 2, $locale);

        return [
            'value' => round($converted, 2),
            'unit' => $unit,
            'formatted' => "{$formattedNum} {$unit}",
        ];
    }

    /**
     * Normaliza um valor para \DateTime (null se inválido).
     */
    private static function asDateTime(mixed $value): ?\DateTimeInterface
    {
        if ($value === null || $value === '') {
            return null;
        }

        if ($value instanceof \DateTimeInterface) {
            return $value;
        }

        try {
            return new \DateTimeImmutable((string) $value);
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Normaliza um locale para um código suportado; se inválido devolve o
     * predefinido.
     */
    public static function sanitize(string $locale): string
    {
        if (self::isSupported($locale)) {
            return $locale;
        }

        $base = strtolower(explode('-', $locale)[0]);
        foreach (self::all() as $code => $meta) {
            if (strtolower(explode('-', $code)[0]) === $base) {
                return $code;
            }
        }

        return self::default();
    }

    /**
     * Resolve o locale da preferência do request.
     *
     * Precedência: sessão → cookie → `Accept-Language` do browser → default.
     * A preferência de BD do utilizador é resolvida pelo middleware (requer
     * autenticação) e persistida na sessão.
     */
    public static function resolveFromRequest(Request $request): string
    {
        $fromSession = self::fromSession($request);
        $fromCookie = self::fromCookie($request);
        $fromBrowser = self::fromBrowser($request);

        return self::sanitize($fromSession ?? $fromCookie ?? $fromBrowser ?? self::default());
    }

    /**
     * Resolve o locale do cabeçalho `Accept-Language` do browser.
     *
     * Cada idioma do browser é tentado por correspondência exata (ex. pt-PT)
     * e, em seguida, por base (ex. pt → pt-PT). Retorna o primeiro hit na
     * ordem do cabeçalho.
     */
    public static function fromBrowser(Request $request): ?string
    {
        $languages = $request->getLanguages();

        if (empty($languages)) {
            return null;
        }

        $byCode = self::all();

        foreach ($languages as $language) {
            if (isset($byCode[$language])) {
                return $language;
            }
        }

        foreach ($languages as $language) {
            $base = strtolower(explode('-', $language)[0]);

            foreach ($byCode as $code => $meta) {
                if (strtolower(explode('-', $code)[0]) === $base) {
                    return $code;
                }
            }
        }

        return null;
    }

    private static function fromSession(Request $request): ?string
    {
        if (! $request->hasSession()) {
            return null;
        }

        $locale = $request->session()->get('locale');

        return is_string($locale) && $locale !== '' ? $locale : null;
    }

    private static function fromCookie(Request $request): ?string
    {
        $locale = $request->cookie('locale');

        return is_string($locale) && $locale !== '' ? $locale : null;
    }

    /**
     * Obtém a moeda ativa para o utilizador (das preferências).
     */
    public static function userCurrency(?Request $request = null): string
    {
        if ($request) {
            return \App\Services\PreferenciasService::getCurrency($request);
        }

        // Para compatibilidade, tentamos obter do user atual
        $user = auth()->user();
        if ($user) {
            $prefs = \App\Services\PreferenciasService::forUser($user);
            return $prefs['currency'];
        }

        return 'EUR';
    }

    /**
     * Obtém o formato de data ativo para o utilizador (das preferências).
     */
    public static function userDateFormat(?Request $request = null): string
    {
        if ($request) {
            return \App\Services\PreferenciasService::getDateFormat($request);
        }

        // Para compatibilidade, tentamos obter do user atual
        $user = auth()->user();
        if ($user) {
            $prefs = \App\Services\PreferenciasService::forUser($user);
            return $prefs['date_format'];
        }

        return 'd/m/Y';
    }

    /**
     * Formata um valor monetário usando a moeda do utilizador.
     */
    public static function formatMoney(int|float $value, ?Request $request = null, ?string $currency = null): string
    {
        $userCurrency = $currency ?? self::userCurrency($request);
        return self::formatCurrency($value, $userCurrency);
    }

    /**
     * Formata uma data usando o formato do utilizador.
     */
    public static function formatUserDate(mixed $value, ?Request $request = null, ?string $format = null): string
    {
        $userFormat = $format ?? self::userDateFormat($request);
        
        if ($value instanceof \DateTimeInterface) {
            return $value->format($userFormat);
        }

        try {
            $date = new \DateTimeImmutable((string) $value);
            return $date->format($userFormat);
        } catch (\Throwable $e) {
            return '';
        }
    }
}
