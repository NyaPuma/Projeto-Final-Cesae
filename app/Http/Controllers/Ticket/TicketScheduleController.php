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
     * Agenda a janela de intervenção para um determinado ticket.
     */
    public function __invoke(ScheduleTicketRequest $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização centralizada via Policy do Laravel
        $this->authorize('schedule', $ticket);

        // 2. Executa o agendamento no action de domínio (valida tickets encerrados e o intervalo)
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

        // 3. Carrega as relações necessárias para a resposta
        $ticket->loadMissing(['equipment', 'room']);

        // 4. Resposta JSON padronizada via API Resource
        return response()->json([
            'message' => __('messages.Intervenção agendada com sucesso.'),
            'ticket' => new TicketResource($ticket),
        ]);
    }
}
