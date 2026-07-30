<?php

namespace App\Http\Controllers\Ticket;

use App\Concerns\BroadcastsTicketStatus;
use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StartTicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Services\NotificationService;
use App\Services\TicketWorkflowService;
use Illuminate\Http\JsonResponse;

final class TicketStartController extends Controller
{
    use BroadcastsTicketStatus;

    public function __construct(
        private readonly TicketWorkflowService $workflowService,
        private readonly NotificationService $notificationService,
    ) {}

    /**
     * Inicia a intervenção num ticket (altera estado para Em Progresso).
     */
    public function __invoke(StartTicketRequest $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização centralizada via Policy do Laravel
        $this->authorize('start', $ticket);

        $user = $request->user();

        // 2. Validação de estado elegível para início
        if (! $ticket->hasStatus(TicketStatusEnum::Open)) {
            return response()->json([
                'message' => __('Apenas tickets no estado "Aberto" podem ser iniciados.'),
            ], 422);
        }

        $oldStatus = $ticket->status;
        $force = $request->boolean('force');
        $higherPriority = $this->workflowService->findHigherPriorityTickets($ticket);

        // 3. Verificação de prioridades mais altas pendentes
        if ($higherPriority['has_higher'] && ! $force) {
            $msg = __("⚠️ Existem :total ticket(s) de prioridade mais alta por atender.", [
                'total' => $higherPriority['total'],
            ]);

            if ($higherPriority['assigned_to_user'] > 0) {
                $msg .= ' ' . __("Destes, :assigned estão atribuídos a si.", [
                    'assigned' => $higherPriority['assigned_to_user'],
                ]);
            }

            $msg .= ' ' . __('Recomenda-se resolver os mais urgentes primeiro.');

            return response()->json([
                'warning' => true,
                'message' => $msg,
                'urgent_tickets_count' => $higherPriority['total'],
                'my_urgent_tickets_count' => $higherPriority['assigned_to_user'],
                'current_priority' => $ticket->priority,
                'can_force' => true,
            ], 409);
        }

        // 4. Delegação da atribuição e início do reparo para o serviço de workflow
        $this->workflowService->startRepair($ticket, $user);

        // 5. Notifica sobre a sobrescrita de prioridade se for o caso
        if ($force && $higherPriority['has_higher']) {
            $this->notificationService->notifyPriorityOverride(
                $ticket,
                $user,
                max($higherPriority['total'], $higherPriority['assigned_to_user'])
            );
        }

        // 6. Transmissão da alteração de estado em tempo real (WebSockets)
        $this->broadcastStatusChange($ticket, $oldStatus, TicketStatusEnum::InProgress);

        $ticket->loadMissing(['equipment', 'room', 'technician', 'status']);

        return response()->json([
            'message' => __('Intervenção iniciada com sucesso.'),
            'overridden' => $force && $higherPriority['has_higher'],
            'ticket' => new TicketResource($ticket),
        ]);
    }
}
