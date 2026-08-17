<?php

declare(strict_types=1);

namespace App\Services;

use Carbon\Carbon;

/**
 * Serviço de apresentação localizada.
 *
 * Mantém a API de formatação separada da resolução de preferências de locale.
 * A implementação usa `intl` quando disponível e conserva os fallbacks do
 * LocaleService para ambientes sem essa extensão.
 */
final class LocalizationService
{
    public function formatNumber(float $value, ?string $locale = null): string
    {
        return LocaleService::formatNumber($value, 0, $locale);
    }

    public function formatDecimal(float $value, int $decimals = 2, ?string $locale = null): string
    {
        return LocaleService::formatNumber($value, $decimals, $locale);
    }

    public function formatCurrency(float $value, ?string $locale = null): string
    {
        return LocaleService::formatCurrency($value, null, $locale);
    }

    public function formatDate(mixed $date, string $format = 'short', ?string $locale = null): string
    {
        if ($date === null || $date === '') {
            return '';
        }

        $date = $date instanceof Carbon ? $date : Carbon::parse($date);
        $targetLocale = $locale ?? app()->getLocale();

        if (class_exists(\IntlDateFormatter::class)) {
            $dateType = match ($format) {
                'long' => \IntlDateFormatter::LONG,
                'medium' => \IntlDateFormatter::MEDIUM,
                default => \IntlDateFormatter::SHORT,
            };

            $formatter = \IntlDateFormatter::create(
                $targetLocale,
                $dateType,
                \IntlDateFormatter::NONE,
                $date->getTimezone()->getName(),
            );

            if ($formatter) {
                $result = $formatter->format($date);
                if ($result !== false) {
                    return $result;
                }
            }
        }

        if ($format === 'short') {
            return match ($targetLocale) {
                'en-US' => $date->format('m/d/Y'),
                'ja-JP', 'zh-CN', 'ko-KR' => $date->format('Y/m/d'),
                default => $date->format('d/m/Y'),
            };
        }

        return $date->locale($targetLocale)->translatedFormat($format === 'long' ? 'j F Y' : 'j M Y');
    }

    public function formatDateTime(mixed $date, ?string $locale = null): string
    {
        if ($date === null || $date === '') {
            return '';
        }

        $date = $date instanceof Carbon ? $date : Carbon::parse($date);
        $targetLocale = $locale ?? app()->getLocale();

        if (class_exists(\IntlDateFormatter::class)) {
            $formatter = \IntlDateFormatter::create(
                $targetLocale,
                \IntlDateFormatter::SHORT,
                \IntlDateFormatter::SHORT,
                $date->getTimezone()->getName(),
            );

            if ($formatter) {
                $result = $formatter->format($date);
                if ($result !== false) {
                    return $result;
                }
            }
        }

        return $this->formatDate($date, 'short', $targetLocale).' '.$date->format('H:i');
    }

    public function formatPercent(float $value, ?string $locale = null): string
    {
        return LocaleService::formatPercent($value, 1, $locale);
    }

    /**
     * @return array{value: float, unit: string, formatted: string}
     */
    public function convertUnit(float $value, string $type, string $fromUnit = '', ?string $locale = null): array
    {
        return LocaleService::convertUnit($value, $type, $fromUnit, $locale);
    }
}
