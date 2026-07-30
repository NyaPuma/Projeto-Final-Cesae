<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;

final class TicketScheduleController extends Controller
{
    /**
     * Agenda a janela de intervenção para um determinado ticket.
     */
    public function __invoke(ScheduleTicketRequest $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização centralizada via Policy do Laravel
        $this->authorize('schedule', $ticket);

        // 2. Atualiza as datas de agendamento usando instâncias de Data/Hora
        $ticket->update([
            'scheduled_at' => $request->date('scheduled_at'),
            'scheduled_end' => $request->date('scheduled_end'),
            'scheduled' => true,
        ]);

        // 3. Carrega as relações necessárias para a resposta
        $ticket->loadMissing(['equipment', 'room', 'technician', 'status']);

        // 4. Resposta JSON padronizada via API Resource
        return response()->json([
            'message' => __('Intervenção agendada com sucesso.'),
            'ticket' => new TicketResource($ticket),
        ]);
    }
}
