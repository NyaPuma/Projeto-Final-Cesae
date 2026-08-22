<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Services\LocaleService;
use App\Services\PreferencesService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware to set user preferences (language, currency, date format).
 *
 * This middleware:
 * 1. Sets App::setLocale() from language preference
 * 2. Exposes helpers to access currency and date format
 */
final class SetUserPreferencesMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Set language from user preferences
        $language = $this->resolveLanguage($request);
        App::setLocale($language);

        // 2. Store current preferences in request for easy access
        $prefs = PreferencesService::current($request);
        $request->merge([
            '_preferences' => $prefs,
        ]);

        return $next($request);
    }

    /**
     * Resolves language from user preferences.
     *
     * Precedence: session → cookie → DB user preferences →
     * browser `Accept-Language` → default. Session/cookie have precedence
     * because they reflect the most recent explicit choice (including the value
     * already persisted by `SetLocaleMiddleware`).
     */
    private function resolveLanguage(Request $request): string
    {
        if ($this->hasExplicitLocale($request)) {
            return LocaleService::resolveFromRequest($request);
        }

        $user = Auth::user() ?? Auth::guard('api')->user();

        if ($user === null) {
            $user = \App\Services\AuthUserResolver::fromRequest($request);
        }

        if ($user !== null) {
            $prefs = PreferencesService::forUser($user);
            if (LocaleService::isSupported($prefs['language'])) {
                return LocaleService::sanitize($prefs['language']);
            }
        }

        return LocaleService::resolveFromRequest($request);
    }

    /**
     * Indicates whether an explicit locale exists in session or cookie.
     */
    private function hasExplicitLocale(Request $request): bool
    {
        if ($request->hasSession()) {
            $sessionLocale = $request->session()->get('locale');

            if (is_string($sessionLocale) && $sessionLocale !== '') {
                return true;
            }
        }

        $cookie = $request->cookie('locale');

        return is_string($cookie) && $cookie !== '';
    }
}
