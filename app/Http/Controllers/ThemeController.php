<?php

namespace App\Http\Controllers;

use App\Models\ThemeSetting;
use App\Services\ThemePresetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

final class ThemeController extends Controller
{
    public function __construct(
        private readonly ThemePresetService $themePresets,
    ) {}

    public function customCss(Request $request): Response
    {
        $settings = ThemeSetting::query()->pluck('value', 'key')->toArray();
        $values = array_merge($this->themeDefaults(), $settings);
        $css = $this->buildCss($values);
        $etag = '"' . sha1($css) . '"';

        if ($request->headers->get('if-none-match') === $etag) {
            return response('', 304)
                ->header('ETag', $etag)
                ->header('Cache-Control', 'no-cache, must-revalidate');
        }

        return response($css, 200, [
            'Content-Type' => 'text/css; charset=utf-8',
            'Cache-Control' => 'no-cache, must-revalidate',
            'ETag' => $etag,
        ]);
    }

    /**
     * Alterna para o preset equivalente (claro <-> escuro da mesma família)
     * e guarda-o — usado pelo botão de modo do painel.
     */
    public function switchTheme(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'theme' => ['required', 'string', Rule::in(array_keys($this->themePresets->all()))],
        ]);

        $preset = $this->themePresets->apply($validated['theme']);

        return response()->json([
            'ok' => true,
            'theme' => $validated['theme'],
            'mode' => $preset['mode'],
            'values' => $this->themePresets->valuesFor($validated['theme']),
        ]);
    }

    /**
     * Hash dos valores de tema guardados, usado como cache-buster (?v=) no
     * link do CSS dinâmico — garante que uma alteração de tema é buscada de
     * imediato, sem ficar presa a caches de browser antigos.
     */
    public static function cacheBuster(): string
    {
        try {
            $raw = ThemeSetting::query()->pluck('value', 'key')->implode('');
        } catch (\Throwable $e) {
            return 'default';
        }

        return substr(sha1($raw), 0, 12);
    }

    private function themeDefaults(): array
    {
        return [
            '--color-primary' => '#ea580c',
            '--color-secondary' => '#14213d',
            '--color-text' => '#0f172a',
            '--color-text-soft' => '#475569',
            '--color-surface' => '#ffffff',
            '--color-surface-alt' => '#e2e8f0',
            '--color-border' => '#cbd5e1',
            '--color-ticket-open' => '#2563eb',
            '--color-ticket-in-progress' => '#f59e0b',
            '--color-ticket-resolved' => '#10b981',
            '--color-ticket-urgent' => '#dc2626',
        ];
    }

    private function buildCss(array $settings): string
    {
        if (isset($settings['--color-primary'])) {
            $rgb = $this->hexToRgb($settings['--color-primary']);
            $settings['--color-primary-light'] = sprintf('rgba(%d, %d, %d, 0.12)', $rgb[0], $rgb[1], $rgb[2]);
            $settings['--color-primary-hover'] = $this->darkenHex($settings['--color-primary'], 0.12);
            $settings['--color-on-primary'] = $this->readableOnColor($settings['--color-primary']);
        }

        $lines = [];

        foreach ($settings as $key => $value) {
            if (! str_starts_with($key, '--')) {
                continue;
            }

            $lines[] = sprintf('    %s: %s;', $key, $value);
        }

        return ":root {\n" . implode("\n", $lines) . "\n}\n";
    }

    /**
     * Escolhe texto legível (preto ou branco puros) sobre a cor primária,
     * garantindo contraste WCAG >= 4.5:1 para qualquer cor de fundo.
     */
    private function readableOnColor(string $hex): string
    {
        $lum = $this->luminance($hex);
        $black = ($lum + 0.05) / 0.05;
        $white = 1.05 / ($lum + 0.05);

        return $white >= $black ? '#ffffff' : '#000000';
    }

    private function luminance(string $hex): float
    {
        [$r, $g, $b] = $this->hexToRgb($hex);
        $convert = fn (int $channel): float => $channel / 255 <= 0.03928
            ? $channel / 255 / 12.92
            : pow((($channel / 255) + 0.055) / 1.055, 2.4);

        return 0.2126 * $convert($r) + 0.7152 * $convert($g) + 0.0722 * $convert($b);
    }

    private function hexToRgb(string $hex): array
    {
        $hex = ltrim($hex, '#');
        return [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2)),
        ];
    }

    private function darkenHex(string $hex, float $amount): string
    {
        [$r, $g, $b] = $this->hexToRgb($hex);
        $darken = fn (int $channel): int => max(0, min(255, (int) round($channel * (1 - $amount))));

        return sprintf('#%02x%02x%02x', $darken($r), $darken($g), $darken($b));
    }
}
