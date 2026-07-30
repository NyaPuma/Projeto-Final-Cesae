<?php

namespace App\Actions;

use App\DTOs\BudgetDecisionData;
use App\Enums\BudgetStatusEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Services\NotificationService;
use App\Services\TicketStatusService;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use RuntimeException;
use Symfony\Component\HttpKernel\Exception\HttpException;

final readonly class ApproveBudgetAction
{
    public function __construct(
        private NotificationService $notificationService,
        private TicketStatusService $statusService,
    ) {}

    public function execute(Ticket $ticket, User $admin, BudgetDecisionData $data): Ticket
    {
        // Guard Clause: Garante que existe um pedido de orçamento pendente
        if (! $ticket->budget_requested || $ticket->budget_status !== BudgetStatusEnum::Pending->value) {
            throw new HttpException(422, 'Não existe pedido de orçamento pendente para este ticket.');
        }

        $isApproved = $data->isApproved();

        $targetTicketStatus = $isApproved ? TicketStatusEnum::InProgress : TicketStatusEnum::Rejected;
        $statusId = $this->statusService->getByName($targetTicketStatus);

        if ($statusId === null) {
            throw new RuntimeException("O estado '{$targetTicketStatus->value}' não foi encontrado no sistema.");
        }

        $ticket = DB::transaction(function () use ($ticket, $admin, $data, $isApproved, $statusId) {
            $ticket->budget_approved_by = $admin->id;
            $ticket->budget_decided_at = now();
            $ticket->status_id = $statusId;

            if ($isApproved) {
                $ticket->budget_status = BudgetStatusEnum::Approved->value;
            } else {
                $ticket->budget_status = BudgetStatusEnum::Rejected->value;
                if (! empty($data->feedback)) {
                    $ticket->budget_feedback = $data->feedback;
                }
            }

            $ticket->save();

            return $ticket;
        });

        $this->notifyDecision($ticket, $data, $isApproved);

        return $ticket->load(['equipment', 'room', 'technician', 'status']);
    }

    private function notifyDecision(Ticket $ticket, BudgetDecisionData $data, bool $isApproved): void
    {
        $amountFormatted = number_format($ticket->budget_amount ?? 0, 2, ',', '.') . '€';

        $message = $isApproved
            ? "O orçamento de {$amountFormatted} para o ticket #{$ticket->id} foi APROVADO."
            : "O orçamento de {$amountFormatted} para o ticket #{$ticket->id} foi RECUSADO.";

        if (! $isApproved && ! empty($data->feedback)) {
            $message .= " Motivo: {$data->feedback}";
        }

        $this->notificationService->notifyBudgetDecision($ticket, $data->decision->value, $message);
    }
}
