<?php

namespace App\Http\Controllers\Ticket;

use App\Concerns\BroadcastsTicketStatus;
use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CloseTicketRequest;
use App\Http\Requests\CloseTicketSimpleRequest;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Services\NotificationService;
use App\Services\TicketWorkflowService;
use Illuminate\Http\JsonResponse;

final class TicketCloseController extends Controller
{
    use BroadcastsTicketStatus;

    public function __construct(
        private readonly TicketWorkflowService $workflowService,
        private readonly NotificationService $notificationService,
    ) {}

    /**
     * Encerramento simples/rápido de ticket em curso.
     */
    public function simpleClose(CloseTicketSimpleRequest $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('close', $ticket);

        // 2. Validação de estado inicial
        if ($ticket->status !== TicketStatusEnum::InProgress) {
            return response()->json([
                'message' => __('Apenas tickets com o estado "Em Curso" podem ser fechados rapidamente.'),
            ], 422);
        }

        $oldStatus = $ticket->status;

        // 3. Execução do workflow de encerramento
        $this->workflowService->close(
            ticket: $ticket,
            cost: $request->float('cost'),
            report: $request->input('technical_report'),
            minutesSpent: $request->integer('minutes_spent')
        );

        // 4. Emissão de evento em tempo real
        $this->broadcastStatusChange($ticket, $oldStatus, TicketStatusEnum::Closed);

        $ticket->loadMissing(['equipment', 'room', 'technician', 'status']);

        return response()->json([
            'message' => __('Ticket fechado com sucesso.'),
            'ticket' => new TicketResource($ticket),
        ]);
    }

    /**
     * Encerramento final com verificação de prioridades pendentes e envio de notificações.
     */
    public function closeFinal(CloseTicketRequest $request, Ticket $ticket): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('close', $ticket);

        $user = $request->user();
        $force = $request->boolean('force');
        $oldStatus = $ticket->status;

        // 2. Validação de tickets pendentes com maior prioridade
        if (! $force) {
            $higherPriority = $this->workflowService->findHigherPriorityTickets($ticket);
            if ($higherPriority['has_higher']) {
                return response()->json([
                    'warning' => true,
                    'message' => __("⚠️ Existem :total ticket(s) de prioridade mais alta por atender.", [
                        'total' => $higherPriority['total'],
                    ]),
                    'urgent_tickets_count' => $higherPriority['total'],
                    'current_priority' => $ticket->priority,
                    'can_force' => true,
                ], 409);
            }
        }

        $cost = $request->float('actual_cost');
        $report = (string) $request->validated('report');

        // 3. Executa o encerramento no serviço de workflow
        $this->workflowService->close(
            ticket: $ticket,
            cost: $cost,
            report: $report,
            minutesSpent: $request->integer('minutes_spent')
        );

        // 4. Notifica se houve sobrescrita de prioridade
        if ($force) {
            $higherPriority = $this->workflowService->findHigherPriorityTickets($ticket);
            if ($higherPriority['has_higher']) {
                $this->notificationService->notifyPriorityOverride($ticket, $user, $higherPriority['total']);
            }
        }

        // 5. Emissão de tempo real via WebSockets
        $this->broadcastStatusChange($ticket, $oldStatus, TicketStatusEnum::Closed);

        // 6. Envio de notificação global de encerramento
        $formattedCost = number_format($cost, 2, ',', '.');
        $this->notificationService->notifyTicketClosed(
            $ticket,
            __("O ticket #:id - :title foi concluído e fechado com custo final de :cost €.", [
                'id' => $ticket->id,
                'title' => $ticket->title,
                'cost' => $formattedCost,
            ])
        );

        $ticket->loadMissing(['equipment', 'room', 'technician', 'status']);

        return response()->json([
            'message' => __('Intervenção concluída e ticket fechado com sucesso.'),
            'ticket' => new TicketResource($ticket),
        ]);
    }
}
