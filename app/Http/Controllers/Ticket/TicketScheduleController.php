<?php

namespace App\Http\Controllers\Ticket;

use App\Actions\ScheduleTicketAction;
use App\DTOs\ScheduleTicketData;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;

final class TicketScheduleController extends Controller
{
    public function __construct(
        private readonly ScheduleTicketAction $scheduleTicketAction,
    ) {}

    /**
     * Schedules the intervention window for a given ticket.
     */
    public function __invoke(ScheduleTicketRequest $request, Ticket $ticket): JsonResponse
    {
        // 1. Centralized authorization via Laravel Policy
        $this->authorize('schedule', $ticket);

        // 2. Execute the scheduling in the domain action (validates closed tickets and the interval)
        try {
            $ticket = $this->scheduleTicketAction->execute(
                $ticket,
                ScheduleTicketData::fromRequest($request),
            );
        } catch (InvalidArgumentException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }

        // 3. Load the relations needed for the response
        $ticket->loadMissing(['equipment', 'room']);

        // 4. Standardized JSON response via API Resource
        return response()->json([
            'message' => __('messages.Intervenção agendada com sucesso.'),
            'ticket' => new TicketResource($ticket),
        ]);
    }
}
