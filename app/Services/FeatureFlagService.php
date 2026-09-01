<?php

declare(strict_types=1);

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Provides cache-backed feature flags with configuration fallbacks.
 */
final class FeatureFlagService
{
    private const CACHE_PREFIX = 'feature-flag:';

    public function enabled(string $feature, ?bool $default = null): bool
    {
        $configured = config("features.flags.{$feature}");
        $fallback = $default ?? (is_bool($configured) ? $configured : false);

        try {
            $override = Cache::get(self::CACHE_PREFIX.$feature);

            return is_bool($override) ? $override : $fallback;
        } catch (Throwable $exception) {
            Log::warning('Feature flag cache lookup failed; using configuration fallback.', [
                'feature' => $feature,
                'exception' => $exception->getMessage(),
            ]);

            return $fallback;
        }
    }

    public function enable(string $feature): void
    {
        $this->store($feature, true);
    }

    public function disable(string $feature): void
    {
        $this->store($feature, false);
    }

    public function clear(string $feature): void
    {
        try {
            Cache::forget(self::CACHE_PREFIX.$feature);
        } catch (Throwable $exception) {
            Log::warning('Feature flag cache clear failed.', [
                'feature' => $feature,
                'exception' => $exception->getMessage(),
            ]);
        }
    }

    private function store(string $feature, bool $enabled): void
    {
        try {
            Cache::forever(self::CACHE_PREFIX.$feature, $enabled);
        } catch (Throwable $exception) {
            Log::warning('Feature flag cache update failed.', [
                'feature' => $feature,
                'enabled' => $enabled,
                'exception' => $exception->getMessage(),
            ]);
        }
    }
}
