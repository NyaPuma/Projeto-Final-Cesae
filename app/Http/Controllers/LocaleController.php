<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\AuthUserResolver;
use App\Services\LocaleService;
use App\Services\PreferenciasService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class LocaleController extends Controller
{
    /**
     * Guarda a preferência de idioma do utilizador.
     *
     * Grava na sessão e num cookie permanente; se o utilizador estiver
     * autenticado, persiste também na coluna `users.locale` e na tabela
     * `user_preferences` para que o middleware de preferências não reverta
     * o locale. Redireciona de volta para a página de origem.
     */
    public function switch(Request $request): RedirectResponse
    {
        $requestedLocale = (string) $request->input('locale');

        if (! LocaleService::isSupported($requestedLocale)) {
            return back()->withErrors(['locale' => __('common.Idioma não suportado.')]);
        }

        $locale = LocaleService::sanitize($requestedLocale);

        $request->session()->put('locale', $locale);
        $cookie = cookie()->forever('locale', $locale);

        $user = $request->user() ?? $request->user('api') ?? AuthUserResolver::fromRequest($request);

        if ($user) {
            $user->forceFill(['locale' => $locale])->save();

            PreferenciasService::saveForUser($user, [
                'language' => $locale,
                'currency' => PreferenciasService::getCurrency($request),
                'date_format' => PreferenciasService::getDateFormat($request),
                'time_format' => PreferenciasService::getTimeFormat($request),
                'number_format' => PreferenciasService::getNumberFormat($request),
            ]);
        }

        return back()->withCookie($cookie);
    }
}
