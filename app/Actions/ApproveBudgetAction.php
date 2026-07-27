<?php

namespace App\Actions;

use App\DTOs\BudgetDecisionData;
use App\Models\Ticket;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;

class ApproveBudgetAction
{
    public function __construct(
        private readonly NotificationService $notificationService,
    ) {}

    public function execute(Ticket $ticket, User $admin, BudgetDecisionData $data): JsonResponse
    {
        if (! $ticket->budget_requested || $ticket->budget_status !== Ticket::BUDGET_PENDING) {
            return response()->json(['message' => 'Não existe pedido de orçamento pendente'], 422);
        }

        $approved = $ticket->approveBudget($admin, $data->decision, $data->feedback);

        if (! $approved) {
            return response()->json(['message' => 'Aprovação falhou'], 422);
        }

        $this->notifyDecision($ticket, $data);

        return response()->json([
            'message' => $data->decision === 'approve'
                ? 'Orçamento aprovado. Ticket desbloqueado para intervenção.'
                : 'Orçamento recusado. Reparação abortada.',
            'ticket' => $ticket->load(['equipment', 'room', 'technician', 'status']),
        ]);
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
