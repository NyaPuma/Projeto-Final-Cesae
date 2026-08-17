<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\LocaleService;
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
 * - Formato de hora (time_format)
 * - Formato de número (number_format)
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
            'currentTimeFormat' => $prefs['time_format'],
            'currentNumberFormat' => $prefs['number_format'] ?? PreferenciasService::getNumberFormat($request),
            'supportedLocales' => LocaleService::all(),
            'supportedCurrencies' => PreferenciasService::supportedCurrencies(),
            'supportedDateFormats' => PreferenciasService::supportedDateFormats(),
            'supportedTimeFormats' => PreferenciasService::supportedTimeFormats(),
            'supportedNumberFormats' => PreferenciasService::supportedNumberFormats(),
        ]);
    }

    /**
     * Resolve o utilizador autenticado (guard web ou token).
     *
     * As rotas de preferências não pertencem ao grupo `custom.auth`, pelo que
     * o guard 'web' não está preenchido; o utilizador é resolvido a partir dos
     * tokens presentes no pedido quando necessário.
     */
    private function resolveUser(Request $request): ?User
    {
        return $request->user() ?? \App\Services\AuthUserResolver::fromRequest($request);
    }

    /**
     * Preferências de origem (BD do utilizador ou sessão), para preservar os
     * campos que não estão a ser atualizados neste pedido.
     */
    private function currentPreferences(Request $request, ?User $user): array
    {
        return $user
            ? PreferenciasService::forUser($user)
            : PreferenciasService::fromSession($request);
    }

    /**
     * Persiste as preferências (BD para utilizadores autenticados, sessão caso
     * contrário) e sincroniza o locale na sessão.
     */
    private function persist(Request $request, ?User $user, array $preferences, string $locale): void
    {
        if ($user) {
            PreferenciasService::saveForUser($user, $preferences);

            // Também atualizar a coluna locale do user para compatibilidade com SetLocaleMiddleware
            $user->forceFill(['locale' => $locale])->save();
        } else {
            PreferenciasService::saveToSession($request, $preferences);
        }

        if ($request->hasSession()) {
            $request->session()->put('locale', $locale);
        }
    }

    /**
     * Atualiza a língua do utilizador.
     */
    public function updateLanguage(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'language' => 'required|string',
        ]);

        $locale = LocaleService::sanitize($validated['language']);

        $user = $this->resolveUser($request);
        $current = $this->currentPreferences($request, $user);

        $preferences = [
            'language' => $locale,
            'currency' => $current['currency'],
            'date_format' => $current['date_format'],
            'time_format' => $current['time_format'],
            'number_format' => $current['number_format'],
        ];

        $this->persist($request, $user, $preferences, $locale);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'language' => $locale,
                'message' => __('preferences.Idioma atualizado com sucesso.'),
            ]);
        }

        return back()->with('success', __('preferences.Idioma atualizado com sucesso.'));
    }

    /**
     * Atualiza a moeda do utilizador.
     */
    public function updateCurrency(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'currency' => 'required|string|size:3',
        ]);

        $user = $this->resolveUser($request);
        $current = $this->currentPreferences($request, $user);

        $preferences = [
            'language' => $current['language'],
            'currency' => $validated['currency'],
            'date_format' => $current['date_format'],
            'time_format' => $current['time_format'],
            'number_format' => $current['number_format'],
        ];

        $this->persist($request, $user, $preferences, $current['language']);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'currency' => $validated['currency'],
                'message' => __('preferences.Moeda atualizada com sucesso.'),
            ]);
        }

        return back()->with('success', __('preferences.Moeda atualizada com sucesso.'));
    }

    /**
     * Atualiza o formato de data do utilizador.
     */
    public function updateDateFormat(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'date_format' => 'required|string',
        ]);

        $user = $this->resolveUser($request);
        $current = $this->currentPreferences($request, $user);

        $preferences = [
            'language' => $current['language'],
            'currency' => $current['currency'],
            'date_format' => $validated['date_format'],
            'time_format' => $current['time_format'],
            'number_format' => $current['number_format'],
        ];

        $this->persist($request, $user, $preferences, $current['language']);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'date_format' => $validated['date_format'],
                'message' => __('preferences.Formato de data atualizado com sucesso.'),
            ]);
        }

        return back()->with('success', __('preferences.Formato de data atualizado com sucesso.'));
    }

    /**
     * Atualiza o formato de hora do utilizador.
     */
    public function updateTimeFormat(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'time_format' => 'required|string',
        ]);

        $user = $this->resolveUser($request);
        $current = $this->currentPreferences($request, $user);

        $preferences = [
            'language' => $current['language'],
            'currency' => $current['currency'],
            'date_format' => $current['date_format'],
            'time_format' => $validated['time_format'],
            'number_format' => $current['number_format'],
        ];

        $this->persist($request, $user, $preferences, $current['language']);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'time_format' => $validated['time_format'],
                'message' => __('preferences.Formato de hora atualizado com sucesso.'),
            ]);
        }

        return back()->with('success', __('preferences.Formato de hora atualizado com sucesso.'));
    }

    /**
     * Atualiza o formato de números do utilizador.
     */
    public function updateNumberFormat(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'number_format' => 'required|string',
        ]);

        $user = $this->resolveUser($request);
        $current = $this->currentPreferences($request, $user);

        $preferences = [
            'language' => $current['language'],
            'currency' => $current['currency'],
            'date_format' => $current['date_format'],
            'time_format' => $current['time_format'],
            'number_format' => $validated['number_format'],
        ];

        $this->persist($request, $user, $preferences, $current['language']);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'number_format' => $validated['number_format'],
                'message' => __('preferences.Formato de números atualizado com sucesso.'),
            ]);
        }

        return back()->with('success', __('preferences.Formato de números atualizado com sucesso.'));
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
            'time_format' => 'required|string',
            'number_format' => 'nullable|string',
        ]);

        $user = $this->resolveUser($request);

        $this->persist($request, $user, $validated, $validated['language']);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'preferences' => $validated,
                'message' => __('preferences.Preferências atualizadas com sucesso.'),
            ]);
        }

        return back()->with('success', __('preferences.Preferências atualizadas com sucesso.'));
    }
}
