<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Services\LocaleService;
use App\Services\PreferenciasService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * Middleware para definir as preferências do utilizador (língua, moeda, formato de data).
 *
 * Este middleware:
 * 1. Define App::setLocale() a partir da preferência de língua
 * 2. Expõe helpers para acessar moeda e formato de data
 */
final class SetUserPreferencesMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Definir a língua a partir das preferências do utilizador
        $language = $this->resolveLanguage($request);
        App::setLocale($language);

        // 2. Guardar as preferências atuais no request para acesso fácil
        $prefs = PreferenciasService::current($request);
        $request->merge([
            '_preferences' => $prefs,
        ]);

        return $next($request);
    }

    /**
     * Resolve a língua a partir das preferências do utilizador.
     *
     * Precedência: sessão → cookie → preferências na BD do utilizador →
     * `Accept-Language` do browser → default. A sessão/cookie têm precedência
     * porque espelham a escolha explícita mais recente (incluindo o valor já
     * persistido pelo `SetLocaleMiddleware`).
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
            $prefs = PreferenciasService::forUser($user);
            if (LocaleService::isSupported($prefs['language'])) {
                return LocaleService::sanitize($prefs['language']);
            }
        }

        return LocaleService::resolveFromRequest($request);
    }

    /**
     * Indica se existe um locale explícito na sessão ou cookie.
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
