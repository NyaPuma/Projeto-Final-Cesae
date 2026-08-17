<?php

namespace App\Http\Controllers;

use App\Actions\ScheduleMaintenanceAction;
use App\DTOs\ScheduleMaintenanceData;
use App\Http\Requests\RescheduleEventRequest;
use App\Http\Requests\ScheduleMaintenanceRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Services\CalendarService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\View\View;
use InvalidArgumentException;

final class CalendarController extends Controller
{
    public function __construct(
        private readonly CalendarService $calendarService,
        private readonly ScheduleMaintenanceAction $scheduleMaintenanceAction,
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

    /**
     * Agenda uma manutenção preventiva, criando um ticket agendado (admin).
     */
    public function scheduleMaintenance(ScheduleMaintenanceRequest $request): JsonResponse
    {
        $this->authorize('create', Ticket::class);

        try {
            $ticket = $this->scheduleMaintenanceAction->execute(
                $request->user(),
                ScheduleMaintenanceData::fromRequest($request),
            );
        } catch (InvalidArgumentException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }

        return response()->json([
            'message' => __('messages.Manutenção preventiva agendada com sucesso.'),
            'ticket' => new TicketResource($ticket),
        ], 201);
    }

    /**
     * Reagenda um evento arrastado no calendário (admin ou técnico atribuído).
     */
    public function reschedule(Ticket $ticket, RescheduleEventRequest $request): JsonResponse
    {
        $user = $request->user();

        $allowed = $user->isAdmin()
            || ($user->isTechnician() && $ticket->assigned_to === $user->id);

        if (! $allowed) {
            abort(403);
        }

        if ($ticket->scheduled_at === null) {
            return response()->json([
                'message' => __('tickets.Este ticket não tem agendamento.'),
            ], 422);
        }

        $start = Carbon::parse($request->validated('start'));

        $ticket->scheduled_at = $start;
        $ticket->scheduled_end = $request->filled('end')
            ? Carbon::parse($request->validated('end'))
            : $start->copy()->addHours(2);
        $ticket->save();

        return response()->json([
            'message' => __('messages.Evento reagendado com sucesso.'),
            'event' => [
                'id' => $ticket->id,
                'start' => $ticket->scheduled_at->toIso8601String(),
                'end' => $ticket->scheduled_end?->toIso8601String(),
            ],
        ]);
    }
}
