<?php

namespace App\Actions;

use App\DTOs\BudgetDecisionData;
use App\Enums\BudgetStatusEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Services\NotificationService;
use App\Services\TicketStatusService;

class ApproveBudgetAction
{
    public function __construct(
        private readonly NotificationService $notificationService,
        private readonly TicketStatusService $statusService,
    ) {}

    public function execute(Ticket $ticket, User $admin, BudgetDecisionData $data): Ticket
    {
        if (! $ticket->budget_requested || $ticket->budget_status !== BudgetStatusEnum::Pending->value) {
            abort(422, 'Não existe pedido de orçamento pendente');
        }

        $ticket->budget_approved_by = $admin->id;
        $ticket->budget_decided_at = now();

        if ($data->decision === 'reject') {
            $ticket->budget_status = BudgetStatusEnum::Rejected->value;
            $rejectedStatusId = $this->statusService->getByName(TicketStatusEnum::Rejected);
            if ($rejectedStatusId) {
                $ticket->status_id = $rejectedStatusId;
            }
            if (! empty($data->feedback)) {
                $ticket->budget_feedback = $data->feedback;
            }
        } else {
            $ticket->budget_status = BudgetStatusEnum::Approved->value;
            $inProgressStatusId = $this->statusService->getByName(TicketStatusEnum::InProgress);
            if ($inProgressStatusId) {
                $ticket->status_id = $inProgressStatusId;
            }
        }

        $ticket->save();

        $this->notifyDecision($ticket, $data);

        return $ticket->load(['equipment', 'room', 'technician', 'status']);
    }

    private function notifyDecision(Ticket $ticket, BudgetDecisionData $data): void
    {
        $message = $data->decision === 'approve'
            ? "O orçamento de {$ticket->budget_amount}€ para o ticket #{$ticket->id} foi APROVADO."
            : "O orçamento de {$ticket->budget_amount}€ para o ticket #{$ticket->id} foi RECUSADO."
                .($data->feedback ? " Motivo: {$data->feedback}" : '');

        $this->notificationService->notifyBudgetDecision($ticket, $data->decision, $message);
    }
}
