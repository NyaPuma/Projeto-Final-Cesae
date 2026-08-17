<?php

namespace App\Http\Controllers;

use App\Services\SystemSettingsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class SystemSettingsController extends Controller
{
    public function __construct(
        private readonly SystemSettingsService $settings,
    ) {}

    /**
     * Página de configurações do sistema (admin).
     */
    public function index(Request $request): View
    {
        return view('ui.definicoes.sistema', [
            'user' => $request->user(),
            'groups' => $this->settings->groups(),
            'values' => $this->settings->values(),
        ]);
    }

    /**
     * Guarda overrides (auto-save de selects/toggles ou botão de cada grupo)
     * ou repõe um grupo inteiro ({reset: groupId}).
     */
    public function update(Request $request): JsonResponse
    {
        $data = $request->validate([
            'updates' => ['sometimes', 'array'],
            'updates.*' => ['present'],
            'reset' => ['sometimes', 'nullable', 'string'],
        ]);

        if (! empty($data['reset'])) {
            $values = $this->settings->reset($data['reset']);

            return response()->json([
                'ok' => true,
                'reset' => $data['reset'],
                'values' => $values,
            ]);
        }

        $saved = $this->settings->update($data['updates'] ?? []);

        return response()->json([
            'ok' => true,
            'values' => $saved,
        ]);
    }
}
