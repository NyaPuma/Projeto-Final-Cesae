<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatusEnum;
use App\Models\Audit;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Room;
use App\Models\ThemeSetting;
use App\Models\User;
use App\Services\EquipmentService;
use App\Services\ThemePresetService;
use App\Services\TicketStatusService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class UiController extends Controller
{
    public function __construct(
        private readonly EquipmentService $equipmentService,
        private readonly ThemePresetService $themePresets,
    ) {}

    /**
     * Renders the main page (dashboard) of the application.
     */
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('ui.index', ['user' => $user]);
    }

    /**
     * Renders the tickets management view.
     */
    public function tickets(Request $request): View
    {
        $user = $request->user();

        return view('ui.tickets', ['user' => $user]);
    }

    /**
     * Renders the ticket creation form.
     */
    public function ticketCreate(Request $request): View
    {
        $user = $request->user();

        return view('ui.ticket-create', ['user' => $user]);
    }

    /**
     * Renders the equipment management view.
     */
    public function equipments(Request $request): View
    {
        $user = $request->user();

        return view('ui.equipments', ['user' => $user]);
    }

    /**
     * Renders the equipment creation form.
     */
    public function equipmentCreate(Request $request): View
    {
        $user = $request->user();

        return view('ui.equipments.create', [
            'user' => $user,
            'rooms' => Room::query()->orderBy('name')->get(),
            'categories' => EquipmentCategory::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Renders the edit form for a specific piece of equipment.
     */
    public function equipmentEdit(Request $request, Equipment $equipment): View
    {
        $user = $request->user();

        return view('ui.equipments.edit', [
            'user' => $user,
            'equipment' => $equipment,
            'rooms' => Room::query()->orderBy('name')->get(),
            'categories' => EquipmentCategory::query()->orderBy('name')->get(),
        ]);
    }

    /**
     * Renders the detail view for a specific piece of equipment.
     */
    public function equipmentDetail(Request $request, Equipment $equipment): View
    {
        $user = $request->user();

        // 1. Relations loaded eagerly for the detail page
        $equipment->loadMissing([
            'room',
            'category',
            'tickets.status',
            'tickets.user',
            'tickets.technician',
        ]);

        // 2. Quick equipment statistics
        $statusService = app(TicketStatusService::class);
        $openStatusId = $statusService->getByName(TicketStatusEnum::Open);
        $inProgressStatusId = $statusService->getByName(TicketStatusEnum::InProgress);

        $tickets = $equipment->tickets->sortByDesc('opened_at');

        // 3. Recent audit trail for this equipment
        $audits = Audit::query()
            ->where('auditable_type', Equipment::class)
            ->where('auditable_id', $equipment->id)
            ->with('user')
            ->latest()
            ->limit(12)
            ->get();

        return view('ui.equipments.show', [
            'user' => $user,
            'equipment' => $equipment,
            'tickets' => $tickets,
            'audits' => $audits,
            'openTicketsCount' => $tickets->where('status_id', $openStatusId)->count(),
            'inProgressTicketsCount' => $tickets->where('status_id', $inProgressStatusId)->count(),
        ]);
    }

    /**
     * Renders the user management view.
     */
    public function users(Request $request): View
    {
        $user = $request->user();

        return view('ui.users', ['user' => $user]);
    }

    /**
     * Renders the user creation form.
     */
    public function userCreate(Request $request): View
    {
        $user = $request->user();

        return view('ui.users-create', ['user' => $user]);
    }

    /**
     * Renders the edit form for a specific user.
     */
    public function userEdit(Request $request, User $targetUser): View
    {
        $user = $request->user();
        $targetUser->loadMissing('profile');

        return view('ui.users-edit', [
            'user' => $user,
            'targetUser' => $targetUser,
        ]);
    }

    /**
     * Renders the detail view for a specific user.
     */
    public function userDetail(Request $request, User $targetUser): View
    {
        $user = $request->user();

        $targetUser->loadMissing('profile');

        return view('ui.users.show', [
            'user' => $user,
            'targetUser' => $targetUser,
        ]);
    }

    /**
     * Renders the room management view.
     */
    public function rooms(Request $request): View
    {
        $user = $request->user();

        return view('ui.rooms', ['user' => $user]);
    }

    /**
     * Renders the room creation form.
     */
    public function roomCreate(Request $request): View
    {
        $user = $request->user();

        return view('ui.rooms.create', ['user' => $user]);
    }

    /**
     * Renders the detail view for a specific room.
     */
    public function roomDetail(Request $request, Room $room): View
    {
        $user = $request->user();

        // 1. Relations loaded eagerly for the detail page
        $room->loadMissing([
            'equipments.category',
            'tickets.status',
            'tickets.user',
            'tickets.technician',
        ]);

        // 2. Quick room statistics
        $statusService = app(TicketStatusService::class);
        $openStatusId = $statusService->getByName(TicketStatusEnum::Open);
        $inProgressStatusId = $statusService->getByName(TicketStatusEnum::InProgress);

        $tickets = $room->tickets->sortByDesc('opened_at');
        $equipments = $room->equipments->sortByDesc('active')->sortByDesc('created_at');

        // 3. Recent audit trail for this room
        $audits = Audit::query()
            ->where('auditable_type', Room::class)
            ->where('auditable_id', $room->id)
            ->with('user')
            ->latest()
            ->limit(12)
            ->get();

        return view('ui.rooms.show', [
            'room' => $room,
            'user' => $user,
            'equipments' => $equipments,
            'tickets' => $tickets,
            'audits' => $audits,
            'openTicketsCount' => $tickets->where('status_id', $openStatusId)->count(),
            'inProgressTicketsCount' => $tickets->where('status_id', $inProgressStatusId)->count(),
        ]);
    }

    /**
     * Renders the edit form for a specific room.
     */
    public function roomEdit(Request $request, Room $room): View
    {
        $user = $request->user();

        return view('ui.rooms.edit', [
            'room' => $room,
            'user' => $user,
        ]);
    }

    /**
     * Renders the system audit log view.
     */
    public function audits(Request $request): View
    {
        $user = $request->user();

        return view('ui.audits', ['user' => $user]);
    }

    /**
     * Renders the detail view for a specific ticket.
     */
    public function ticketDetail(Request $request, int $id): View
    {
        $user = $request->user();

        return view('ui.ticket-detail', [
            'ticketId' => $id,
            'user' => $user,
        ]);
    }

    /**
     * Helper JSON endpoint for paginated equipment listing in the UI.
     */
    public function getEquipments(Request $request): JsonResponse
    {
        $request->user();

        $equipments = $this->equipmentService->listPaginated(
            $request->query('q'),
            $request->query('status'),
        );

        return response()->json([
            'equipments' => $equipments,
        ]);
    }

    /**
     * Renders the reports and analytics view.
     */
    public function analytics(Request $request): View
    {
        $user = $request->user();

        return view('ui.analytics', ['user' => $user]);
    }

    /**
     * Renders the authenticated user's profile view.
     */
    public function profile(Request $request): View
    {
        $user = $request->user();

        return view('ui.profile', ['user' => $user]);
    }

    /**
     * Renders the panel appearance settings page.
     */
    public function themeAppearance(Request $request): View
    {
        $user = $request->user();
        $settings = ThemeSetting::query()->pluck('value', 'key')->toArray();

        $defaults = [
            '--color-primary' => '#ea580c',
            '--color-text' => '#0f172a',
            '--color-text-soft' => '#475569',
            '--color-surface' => '#ffffff',
            '--color-surface-alt' => '#e2e8f0',
            '--color-border' => '#cbd5e1',
            '--color-ticket-open' => '#2563eb',
            '--color-ticket-in-progress' => '#f59e0b',
            '--color-ticket-resolved' => '#10b981',
            '--color-ticket-urgent' => '#dc2626',
        ];

        return view('ui.definicoes.aparencia', [
            'user' => $user,
            'settings' => array_merge($defaults, $settings),
            'presets' => $this->themePresets->all(),
        ]);
    }

    /**
     * Predefined themes with guaranteed contrast (WCAG AA):
     * text and secondary text >= 4.5:1 over the surface,
     * primary >= 3:1 over the surface and button text >= 4.5:1.
     * Each family has a light/dark pair that the panel button toggles.
     */
    private function themePresets(): array
    {
        return $this->themePresets->all();
    }

    /**
     * Saves the appearance settings chosen by the administrator.
     */
    public function themeAppearanceUpdate(Request $request): JsonResponse|RedirectResponse
    {
        $validated = $request->validate([
            'primary' => ['required', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'text' => ['required', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'text_soft' => ['required', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'surface' => ['required', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'surface_alt' => ['required', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'border' => ['required', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'ticket_open' => ['required', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'ticket_in_progress' => ['required', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'ticket_resolved' => ['required', 'regex:/^#([A-Fa-f0-9]{6})$/'],
            'ticket_urgent' => ['required', 'regex:/^#([A-Fa-f0-9]{6})$/'],
        ]);

        $validated['primary'] = $this->ensureContrast($validated['primary'], $validated['surface'], 3.0);
        $validated['text'] = $this->ensureContrast($validated['text'], $validated['surface'], 4.5);
        $validated['text_soft'] = $this->ensureContrast($validated['text_soft'], $validated['surface'], 4.5);

        $mapping = [
            'primary' => '--color-primary',
            'text' => '--color-text',
            'text_soft' => '--color-text-soft',
            'surface' => '--color-surface',
            'surface_alt' => '--color-surface-alt',
            'border' => '--color-border',
            'ticket_open' => '--color-ticket-open',
            'ticket_in_progress' => '--color-ticket-in-progress',
            'ticket_resolved' => '--color-ticket-resolved',
            'ticket_urgent' => '--color-ticket-urgent',
        ];

        foreach ($mapping as $input => $token) {
            ThemeSetting::updateOrCreate(
                ['key' => $token],
                ['value' => $validated[$input]]
            );
        }

        $themeName = $this->themePresets->findByValues($validated);

        ThemeSetting::updateOrCreate(
            ['key' => 'theme_name'],
            ['value' => $themeName ?? '']
        );

        if ($request->expectsJson()) {
            return response()->json([
                'ok' => true,
                'theme_name' => $themeName,
                'mode' => $themeName !== null ? $this->themePresets->find($themeName)['mode'] : null,
            ]);
        }

        return redirect()->route('ui.definicoes.aparencia')
            ->with('status', __('messages.As definições de aparência foram guardadas com sucesso.'));
    }

    private function hexToRgb(string $hex): array
    {
        $hex = ltrim($hex, '#');
        return [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2)),
        ];
    }

    private function luminance(string $hex): float
    {
        [$r, $g, $b] = $this->hexToRgb($hex);
        $convert = fn (int $channel): float => $channel / 255 <= 0.03928
            ? $channel / 255 / 12.92
            : pow((($channel / 255) + 0.055) / 1.055, 2.4);

        return 0.2126 * $convert($r)
            + 0.7152 * $convert($g)
            + 0.0722 * $convert($b);
    }

    private function contrastRatio(string $foreground, string $background): float
    {
        $lumA = $this->luminance($foreground);
        $lumB = $this->luminance($background);
        $lighter = max($lumA, $lumB);
        $darker = min($lumA, $lumB);

        return ($lighter + 0.05) / ($darker + 0.05);
    }

    private function rgbToHex(int $r, int $g, int $b): string
    {
        $clamp = fn (int $channel): int => max(0, min(255, (int) round($channel)));

        return sprintf('#%02x%02x%02x', $clamp($r), $clamp($g), $clamp($b));
    }

    private function mixToward(string $hex, string $target, float $amount): string
    {
        [$r, $g, $b] = $this->hexToRgb($hex);
        [$tr, $tg, $tb] = $this->hexToRgb($target);

        return $this->rgbToHex(
            $r + ($tr - $r) * $amount,
            $g + ($tg - $g) * $amount,
            $b + ($tb - $b) * $amount,
        );
    }

    /**
     * Automatically adjusts the color (darkening or lightening toward whichever
     * extreme best ensures contrast) until the minimum ratio against the background is met.
     */
    private function ensureContrast(string $hex, string $background, float $minRatio): string
    {
        $current = $hex;
        $endpoint = $this->readableOnColor($background);
        $guard = 0;

        while ($this->contrastRatio($current, $background) < $minRatio && $guard < 40) {
            $current = $this->mixToward($current, $endpoint, 0.12);
            $guard++;
        }

        return $current;
    }

    /**
     * Picks readable text color (pure black or white) over a given color,
     * ensuring WCAG contrast >= 4.5:1 for any background.
     */
    private function readableOnColor(string $hex): string
    {
        $lum = $this->luminance($hex);
        $black = ($lum + 0.05) / 0.05;
        $white = 1.05 / ($lum + 0.05);

        return $white >= $black ? '#ffffff' : '#000000';
    }
}
