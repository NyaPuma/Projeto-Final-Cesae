<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Services\AuthUserResolver;
use App\Services\LocaleService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

final class SetLocaleMiddleware
{
    /**
     * Locale aplicado quando nenhuma preferência é encontrada.
     */
    public const DEFAULT_LOCALE = 'pt-PT';

    /**
     * Resolve o locale a usar no pedido e define-o na aplicação.
     *
     * Precedência: sessão → cookie → BD do utilizador autenticado →
     * `Accept-Language` do browser → default.
     */
    public function handle(Request $request, Closure $next): Response
    {
        App::setLocale($this->resolveLocale($request));

        return $next($request);
    }

    /**
     * Resolve o locale preferido de um request (usado também no handler de
     * erros e em rotas fora do grupo web).
     */
    public static function resolveFromRequest(Request $request): string
    {
        $fromSession = self::sessionLocale($request);
        $fromCookie = self::cookieLocale($request);

        if ($fromSession !== null) {
            return LocaleService::sanitize($fromSession);
        }

        if ($fromCookie !== null) {
            return LocaleService::sanitize($fromCookie);
        }

        return LocaleService::resolveFromRequest($request);
    }

    /**
     * Resolve a preferência completa, incluindo a BD do utilizador.
     */
    private function resolveLocale(Request $request): string
    {
        $fromSession = self::sessionLocale($request);

        if ($fromSession !== null) {
            return LocaleService::sanitize($fromSession);
        }

        $fromUser = $this->authenticatedUserLocale($request);

        if ($fromUser !== null) {
            if ($request->hasSession()) {
                $request->session()->put('locale', $fromUser);
            }

            return $fromUser;
        }

        $fromCookie = self::cookieLocale($request);

        if ($fromCookie !== null) {
            return LocaleService::sanitize($fromCookie);
        }

        return LocaleService::resolveFromRequest($request);
    }

    /**
     * Locale guardado na sessão, se existir.
     */
    private static function sessionLocale(Request $request): ?string
    {
        if (! $request->hasSession()) {
            return null;
        }

        $locale = $request->session()->get('locale');

        return is_string($locale) && $locale !== '' ? $locale : null;
    }

    /**
     * Locale guardado no cookie, se existir.
     */
    private static function cookieLocale(Request $request): ?string
    {
        $locale = $request->cookie('locale');

        return is_string($locale) && $locale !== '' ? $locale : null;
    }

    /**
     * Locale preferido do utilizador autenticado (coluna `users.locale`).
     *
     * O guard 'api' ainda não está preenchido quando este middleware corre
     * (o `CustomAuthMiddleware` é do grupo da rota), pelo que o utilizador é
     * resolvido a partir dos tokens do pedido quando necessário.
     */
    private function authenticatedUserLocale(Request $request): ?string
    {
        $user = Auth::user() ?? Auth::guard('api')->user();

        if ($user === null) {
            $user = AuthUserResolver::fromRequest($request);
        }

        if ($user === null || $user->locale === null || $user->locale === '') {
            return null;
        }

        if (! LocaleService::isSupported($user->locale)) {
            Log::debug('Locale do utilizador não suportado', ['locale' => $user->locale]);

            return null;
        }

        return LocaleService::sanitize($user->locale);
    }
}
