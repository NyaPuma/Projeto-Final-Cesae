<?php

namespace App\Http\Controllers\Ticket;

use App\Concerns\BroadcastsTicketStatus;
use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Services\TicketWorkflowService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class TicketLifecycleController extends Controller
{
    use BroadcastsTicketStatus;

    public function __construct(
        private readonly TicketWorkflowService $workflowService,
    ) {}

    /**
     * Reabre um ticket anteriormente fechado ou cancelado.
     */
    public function reopen(Request $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('reopen', $ticket);

        $oldStatus = $ticket->status;

        // 2. Executa a reabertura no serviço de workflow
        if (! $this->workflowService->reopen($ticket)) {
            return response()->json([
                'message' => __('tickets.Apenas tickets fechados ou cancelados podem ser reabertos.'),
            ], 422);
        }

        // Invalida a relação em cache para refletir o novo estado
        $ticket->unsetRelation('status');

        // 3. Notifica clientes via WebSockets sobre a mudança de estado
        $this->broadcastStatusChange($ticket, $oldStatus, $ticket->status);

        $ticket->loadMissing(['equipment', 'room', 'technician', 'status']);

        return response()->json([
            'message' => __('messages.Ticket reaberto com sucesso.'),
            'ticket' => new TicketResource($ticket),
        ]);
    }

    /**
     * Cancela um ticket submetido pelo utilizador.
     */
    public function cancel(Request $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização via Policy (Valida se é o dono e se tem permissão)
        $this->authorize('cancel', $ticket);

        // 2. Validação de estado elegível para cancelamento
        if (! $ticket->hasStatus(TicketStatusEnum::Open)) {
            return response()->json([
                'message' => __('tickets.Apenas tickets no estado "Aberto" podem ser cancelados.'),
            ], 422);
        }

        $oldStatus = $ticket->status;

        // 3. Executa o cancelamento no serviço
        $this->workflowService->cancel($ticket);

        // Invalida a relação em cache para refletir o novo estado
        $ticket->unsetRelation('status');

        // 4. Emite o evento WebSocket
        $this->broadcastStatusChange($ticket, $oldStatus, TicketStatusEnum::Cancelled);

        $ticket->loadMissing(['equipment', 'room', 'technician', 'status']);

        return response()->json([
            'message' => __('messages.Ticket cancelado com sucesso.'),
            'ticket' => new TicketResource($ticket),
        ]);
    }
}
