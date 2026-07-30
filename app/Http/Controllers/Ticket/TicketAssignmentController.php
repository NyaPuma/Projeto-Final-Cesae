<?php

namespace App\Http\Controllers\Ticket;

use App\Concerns\BroadcastsTicketStatus;
use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignTechnicianToTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Services\TechnicianAssignmentService;
use Illuminate\Http\JsonResponse;

final class TicketAssignmentController extends Controller
{
    use BroadcastsTicketStatus;

    public function __construct(
        private readonly TechnicianAssignmentService $technicianService,
    ) {}

    /**
     * Atribui um técnico a um ticket e atualiza o estado para Em Progresso.
     */
    public function __invoke(AssignTechnicianToTicketRequest $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização via Policy nativa do Laravel
        $this->authorize('assign', $ticket);

        // 2. Preserva o estado anterior diretamente como Enum
        $oldStatus = $ticket->status;

        // 3. Executa a atribuição no serviço de domínio
        $technicianId = $request->integer('technician_id');
        $this->technicianService->assignToTicket($ticket, $technicianId);

        // 4. Emite a alteração de estado para os canais de WebSocket
        $this->broadcastStatusChange($ticket, $oldStatus, TicketStatusEnum::InProgress);

        // 5. Carrega relações necessárias para o Resource
        $ticket->loadMissing(['equipment', 'room', 'technician', 'status']);

        return response()->json([
            'message' => 'Técnico atribuído com sucesso.',
            'ticket' => new TicketResource($ticket),
        ]);
    }
}
