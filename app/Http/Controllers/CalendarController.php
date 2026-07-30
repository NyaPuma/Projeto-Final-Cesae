<?php

namespace App\Http\Controllers;

use App\Services\CalendarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

final class CalendarController extends Controller
{
    public function __construct(
        private readonly CalendarService $calendarService,
    ) {}

    /**
     * Renderiza a vista do calendário para o utilizador autenticado.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        $events = $this->calendarService->getScheduledEventsForUser($user);

        return view('calendar', compact('events', 'user'));
    }

    /**
     * Retorna os eventos agendados do utilizador em formato JSON.
     */
    public function events(Request $request): JsonResponse
    {
        $user = $request->user();
        $events = $this->calendarService->getScheduledEventsForUser($user);

        return response()->json([
            'events' => $events,
        ]);
    }
}
