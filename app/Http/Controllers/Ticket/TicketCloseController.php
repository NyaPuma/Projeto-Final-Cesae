<?php

namespace App\Http\Controllers\Ticket;

use App\Concerns\BroadcastsTicketStatus;
use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\CloseTicketRequest;
use App\Http\Requests\CloseTicketSimpleRequest;
use App\Models\Ticket;
use App\Models\User;
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

    public function __invoke(CloseTicketSimpleRequest $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN]);

        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status->name ?? '';

        if (! $ticket->hasStatus(TicketStatusEnum::InProgress)) {
            return response()->json(['message' => 'Apenas tickets em "Em Curso" podem ser fechados.'], 422);
        }

        $this->workflowService->close(
            $ticket,
            cost: $request->float('cost'),
            report: $request->input('technical_report'),
            minutesSpent: $request->integer('minutes_spent')
        );

        $this->broadcastStatusChange($ticket, $oldStatus, TicketStatusEnum::Closed);

        return response()->json(['ticket' => $ticket]);
    }

    public function closeFinal(CloseTicketRequest $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $ticket = Ticket::findOrFail($id);
        $force = (bool) $request->validated('force', false);

        if (! $force) {
            $higherPriority = $this->workflowService->findHigherPriorityTickets($ticket);
            if ($higherPriority['has_higher']) {
                return response()->json([
                    'warning' => true,
                    'message' => "⚠️ Existem {$higherPriority['total']} ticket(s) de prioridade mais alta por atender.",
                    'urgent_tickets_count' => $higherPriority['total'],
                    'current_priority' => $ticket->priority,
                    'can_force' => true,
                ], 409);
            }
        }

        $cost = (float) $request->validated('actual_cost');
        $report = $request->validated('report');

        $this->workflowService->close($ticket, $cost, $report);

        if ($force) {
            $higherPriority = $this->workflowService->findHigherPriorityTickets($ticket);
            if ($higherPriority['has_higher']) {
                $this->notificationService->notifyPriorityOverride($ticket, $user, $higherPriority['total']);
            }
        }

        $this->notificationService->notifyTicketClosed(
            $ticket,
            "O ticket #{$ticket->id} - {$ticket->title} foi concluído e fechado com custo final de {$cost}€."
        );

        return response()->json([
            'message' => __('Intervenção concluída e ticket fechado com sucesso.'),
            'ticket' => $ticket->load(['equipment', 'room', 'technician', 'status']),
        ]);
    }
}
