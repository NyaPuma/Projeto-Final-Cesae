<?php

namespace App\Http\Controllers\Ticket;

use App\Concerns\BroadcastsTicketStatus;
use App\Enums\TicketStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StartTicketRequest;
use App\Models\Ticket;
use App\Models\User;
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

    public function __invoke(StartTicketRequest $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN]);

        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status->name ?? '';

        if (! $ticket->hasStatus(TicketStatusEnum::Open)) {
            return response()->json(['message' => 'Apenas tickets em estado "Aberto" podem ser iniciados.'], 422);
        }

        $force = $request->boolean('force', false);
        $higherPriority = $this->workflowService->findHigherPriorityTickets($ticket);

        if ($higherPriority['has_higher'] && ! $force) {
            $msg = "⚠️ Existem {$higherPriority['total']} ticket(s) de prioridade mais alta por atender.";
            if ($higherPriority['assigned_to_user'] > 0) {
                $msg .= " Destes, {$higherPriority['assigned_to_user']} estão atribuídos a si.";
            }
            $msg .= ' Recomenda-se resolver os mais urgentes primeiro.';

            return response()->json([
                'warning' => true,
                'message' => $msg,
                'urgent_tickets_count' => $higherPriority['total'],
                'my_urgent_tickets_count' => $higherPriority['assigned_to_user'],
                'current_priority' => $ticket->priority,
                'can_force' => true,
            ], 409);
        }

        if (! $ticket->assigned_to) {
            $ticket->assigned_to = $user->id;
        }

        $this->workflowService->startRepair($ticket);

        if ($force && $higherPriority['has_higher']) {
            $this->notificationService->notifyPriorityOverride(
                $ticket,
                $user,
                max($higherPriority['total'], $higherPriority['assigned_to_user'])
            );
        }

        $this->broadcastStatusChange($ticket, $oldStatus, TicketStatusEnum::InProgress);

        return response()->json([
            'ticket' => $ticket,
            'overridden' => $force && $higherPriority['has_higher'],
        ]);
    }
}
