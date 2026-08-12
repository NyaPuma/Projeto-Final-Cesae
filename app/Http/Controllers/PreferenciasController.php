<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\PreferenciasService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Controlador para gerir preferências do utilizador.
 *
 * Permite ao utilizador configurar independentemente:
 * - Língua (language)
 * - Moeda (currency)
 * - Formato de data (date_format)
 */
final class PreferenciasController extends Controller
{
    /**
     * Mostra o formulário de preferências.
     */
    public function edit(Request $request): View
    {
        $prefs = PreferenciasService::current($request);

        return view('preferences.edit', [
            'currentLanguage' => $prefs['language'],
            'currentCurrency' => $prefs['currency'],
            'currentDateFormat' => $prefs['date_format'],
            'supportedLocales' => \App\Services\LocaleService::all(),
            'supportedCurrencies' => PreferenciasService::supportedCurrencies(),
            'supportedDateFormats' => PreferenciasService::supportedDateFormats(),
        ]);
    }

    /**
     * Atualiza a língua do utilizador.
     */
    public function updateLanguage(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'language' => 'required|string',
        ]);

        $user = $request->user();

        if ($user) {
            PreferenciasService::saveForUser($user, [
                'language' => $validated['language'],
                'currency' => PreferenciasService::getCurrency($request),
                'date_format' => PreferenciasService::getDateFormat($request),
            ]);
        } else {
            PreferenciasService::saveToSession($request, [
                'language' => $validated['language'],
                'currency' => PreferenciasService::getCurrency($request),
                'date_format' => PreferenciasService::getDateFormat($request),
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'language' => $validated['language'],
                'message' => __('Idioma atualizado com sucesso.'),
            ]);
        }

        return back()->with('success', __('Idioma atualizado com sucesso.'));
    }

    /**
     * Atualiza a moeda do utilizador.
     */
    public function updateCurrency(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'currency' => 'required|string|size:3',
        ]);

        $user = $request->user();

        if ($user) {
            PreferenciasService::saveForUser($user, [
                'language' => PreferenciasService::getLanguage($request),
                'currency' => $validated['currency'],
                'date_format' => PreferenciasService::getDateFormat($request),
            ]);
        } else {
            PreferenciasService::saveToSession($request, [
                'language' => PreferenciasService::getLanguage($request),
                'currency' => $validated['currency'],
                'date_format' => PreferenciasService::getDateFormat($request),
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'currency' => $validated['currency'],
                'message' => __('Moeda atualizada com sucesso.'),
            ]);
        }

        return back()->with('success', __('Moeda atualizada com sucesso.'));
    }

    /**
     * Atualiza o formato de data do utilizador.
     */
    public function updateDateFormat(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'date_format' => 'required|string',
        ]);

        $user = $request->user();

        if ($user) {
            PreferenciasService::saveForUser($user, [
                'language' => PreferenciasService::getLanguage($request),
                'currency' => PreferenciasService::getCurrency($request),
                'date_format' => $validated['date_format'],
            ]);
        } else {
            PreferenciasService::saveToSession($request, [
                'language' => PreferenciasService::getLanguage($request),
                'currency' => PreferenciasService::getCurrency($request),
                'date_format' => $validated['date_format'],
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'date_format' => $validated['date_format'],
                'message' => __('Formato de data atualizado com sucesso.'),
            ]);
        }

        return back()->with('success', __('Formato de data atualizado com sucesso.'));
    }

    /**
     * Atualiza todas as preferências de uma vez.
     */
    public function updateAll(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'language' => 'required|string',
            'currency' => 'required|string|size:3',
            'date_format' => 'required|string',
        ]);

        $user = $request->user();

        if ($user) {
            PreferenciasService::saveForUser($user, $validated);
        } else {
            PreferenciasService::saveToSession($request, $validated);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'preferences' => $validated,
                'message' => __('Preferências atualizadas com sucesso.'),
            ]);
        }

        return back()->with('success', __('Preferências atualizadas com sucesso.'));
    }
}
