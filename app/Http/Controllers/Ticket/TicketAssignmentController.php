<?php

namespace App\Http\Controllers\Ticket;

use App\Concerns\BroadcastsTicketStatus;
use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignTechnicianToTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Services\TechnicianAssignmentService;
use App\Services\TicketWorkflowService;
use Illuminate\Http\JsonResponse;

final class TicketAssignmentController extends Controller
{
    use BroadcastsTicketStatus;

    public function __construct(
        private readonly TechnicianAssignmentService $technicianService,
        private readonly TicketWorkflowService $workflowService,
    ) {}

    /**
     * Atribui um técnico a um ticket e atualiza o estado para Em Progresso.
     */
    public function __invoke(AssignTechnicianToTicketRequest $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização via Policy nativa do Laravel
        $this->authorize('assign', $ticket);

        // 2. Guard: tickets encerrados não podem receber técnico
        if ($ticket->hasStatus(TicketStatusEnum::Closed) || $ticket->hasStatus(TicketStatusEnum::Cancelled)) {
            return response()->json([
                'message' => __('tickets.Não é possível atribuir um técnico a um ticket encerrado.'),
            ], 422);
        }

        // 3. Preserva o estado anterior diretamente como Enum
        $oldStatus = $ticket->status;

        // 4. Executa a atribuição no serviço de domínio (suporta null = atribuição automática)
        $technicianId = $request->validated()['technician_id'] ?? null;
        $technician = $this->technicianService->assignToTicket($ticket, $technicianId);

        // 5. Trata a falha de atribuição (técnico inválido/indisponível)
        if ($technician === null) {
            $message = $technicianId
                ? __('validation.Técnico selecionado é inválido ou indisponível.')
                : __('common.Não existem técnicos disponíveis de momento.');

            return response()->json(['message' => $message], 422);
        }

        // 6. Transita o ticket para Em Progresso (consistente com o broadcast)
        $this->workflowService->startRepair($ticket);

        // Evita que a relação de estado (já carregada) fique obsoleta na resposta
        $ticket->unsetRelation('status');

        // 7. Emite a alteração de estado para os canais de WebSocket
        $this->broadcastStatusChange($ticket, $oldStatus, TicketStatusEnum::InProgress);

        // 8. Carrega relações necessárias para o Resource
        $ticket->loadMissing(['equipment', 'room', 'technician', 'status']);

        return response()->json([
            'message' => __('messages.Técnico atribuído com sucesso.'),
            'ticket' => new TicketResource($ticket),
        ]);
    }
}
