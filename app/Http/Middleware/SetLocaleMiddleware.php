<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Try to get locale from cookie first, then session
        $locale = $request->cookie('locale') ?: ($request->hasSession() ? $request->session()->get('locale') : null);

        // Fallback to browser preference or 'pt'
        if (!$locale) {
            $locale = $request->getPreferredLanguage(['en', 'pt']) ?: 'pt';
        }

        if (in_array($locale, ['en', 'pt'])) {
            App::setLocale($locale);
        } else {
            App::setLocale('pt');
        }

        return $next($request);
    }
}
