<?php

namespace App\Http\Controllers;

use App\Enums\TicketStatusEnum;
use App\Events\TicketStatusUpdatedBroadcast;
use App\Http\Requests\CloseTicketRequest;
use App\Http\Requests\ScheduleTicketRequest;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketStatusChanged;
use App\Services\NotificationService;
use App\Services\TechnicianAssignmentService;
use App\Services\TicketStatusService;
use App\Services\TicketWorkflowService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TicketWorkflowController extends Controller
{
    public function __construct(
        private readonly TicketWorkflowService $workflowService,
        private readonly TicketStatusService $statusService,
        private readonly NotificationService $notificationService,
        private readonly TechnicianAssignmentService $technicianService,
    ) {}

    public function start(Request $request, int $id): JsonResponse
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

    public function close(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN]);

        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status->name ?? '';

        if (! $ticket->hasStatus(TicketStatusEnum::InProgress)) {
            return response()->json(['message' => 'Apenas tickets em "Em Curso" podem ser fechados.'], 422);
        }

        $request->validate([
            'minutes_spent' => ['nullable', 'integer', 'min:0'],
            'cost' => ['nullable', 'numeric', 'min:0'],
            'technical_report' => ['nullable', 'string', 'max:5000'],
        ]);

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

        DB::transaction(fn () => $this->workflowService->close($ticket, $cost, $report));

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

    public function reopen(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $ticket = Ticket::findOrFail($id);

        if (! $this->workflowService->reopen($ticket)) {
            return response()->json(['message' => 'Só é possível reabrir tickets fechados'], 422);
        }

        return response()->json(['ticket' => $ticket]);
    }

    public function cancel(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);

        if (! $user->isCommon()) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        $ticket = Ticket::findOrFail($id);

        if ($ticket->user_id !== $user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        if (! $ticket->hasStatus(TicketStatusEnum::Open)) {
            return response()->json(['message' => 'Só é possível cancelar tickets abertos'], 403);
        }

        $this->workflowService->cancel($ticket);

        return response()->json(['ticket' => $ticket]);
    }

    public function schedule(ScheduleTicketRequest $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $ticket = Ticket::findOrFail($id);

        if ($user->isCommon() && (int) $ticket->user_id !== (int) $user->id) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        $ticket->update([
            'scheduled_at' => $request->validated('scheduled_at'),
            'scheduled_end' => $request->validated('scheduled_end'),
            'scheduled' => true,
        ]);

        return response()->json(['ticket' => $ticket]);
    }

    public function assignTechnician(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_TECHNICIAN, User::ROLE_ADMIN]);

        $request->validate(['tecnico_id' => 'required|exists:users,id']);

        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status->name ?? '';

        $this->technicianService->assignToTicket($ticket, (int) $request->tecnico_id);

        $this->broadcastStatusChange($ticket, $oldStatus, TicketStatusEnum::InProgress);

        return response()->json(['ticket' => $ticket->load(['equipment', 'room', 'technician', 'status'])]);
    }

    private function broadcastStatusChange(Ticket $ticket, string $oldStatus, TicketStatusEnum $newStatus): void
    {
        try {
            event(new TicketStatusUpdatedBroadcast($ticket, $oldStatus, $newStatus->value));
            if ($ticket->user && $ticket->user->email) {
                $ticket->user->notify(new TicketStatusChanged($ticket, $oldStatus, $newStatus->value));
            }
        } catch (\Exception $e) {
        }
    }
}
