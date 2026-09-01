<?php

declare(strict_types=1);

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
     * System settings page (admin).
     */
    public function index(Request $request): View
    {
        return view('ui.settings.system', [
            'user' => $request->user(),
            'groups' => $this->settings->groups(),
            'values' => $this->settings->values(),
        ]);
    }

    /**
     * Saves overrides (auto-save of selects/toggles or each group's button)
     * or resets an entire group ({reset: groupId}).
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

        $updates = is_array($request->input('updates'))
            ? \Illuminate\Support\Arr::dot($request->input('updates'))
            : [];

        $saved = $this->settings->update($updates);

        return response()->json([
            'ok' => true,
            'values' => $saved,
        ]);
    }
}
