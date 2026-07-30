<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

final class SetLocaleMiddleware
{
    private const SUPPORTED_LOCALES = ['en', 'pt'];
    private const DEFAULT_LOCALE = 'pt';

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->resolveLocale($request);

        App::setLocale($locale);

        return $next($request);
    }

    /**
     * Resolve o idioma pretendido através de cookie, sessão, preferências do browser ou fallback.
     */
    private function resolveLocale(Request $request): string
    {
        // Tenta obter o idioma do cookie ou, em alternativa, da sessão
        $locale = $request->cookie('locale') ?? ($request->hasSession() ? $request->session()->get('locale') : null);

        // Se não existir ou não for suportado, recorre à preferência do browser
        if (! $locale || ! in_array($locale, self::SUPPORTED_LOCALES, true)) {
            $locale = $request->getPreferredLanguage(self::SUPPORTED_LOCALES) ?? self::DEFAULT_LOCALE;
        }

        // Validação final de segurança para garantir que pertence aos suportados
        return in_array($locale, self::SUPPORTED_LOCALES, true) ? $locale : self::DEFAULT_LOCALE;
    }
}
