<?php

namespace App\Actions;

use App\DTOs\BudgetSubmissionData;
use App\Enums\BudgetStatusEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

final readonly class SubmitBudgetAction
{
    public function execute(Ticket $ticket, BudgetSubmissionData $data): Ticket
    {
        // Guard Clause: Não permite submeter orçamento para tickets encerrados
        if ($ticket->hasStatus(TicketStatusEnum::Closed)) {
            throw new InvalidArgumentException("Não é possível submeter um orçamento para um ticket que já se encontra encerrado.");
        }

        // Guard Clause: Previne submeter novo orçamento se já existir um pendente
        if ($ticket->budget_status === BudgetStatusEnum::Pending->value) {
            throw new InvalidArgumentException("Já existe um pedido de orçamento pendente para este ticket.");
        }

        if ($data->estimatedBudget <= 0) {
            throw new InvalidArgumentException("O valor do orçamento deve ser superior a 0.");
        }

        return DB::transaction(function () use ($ticket, $data) {
            $ticket->update([
                'budget_requested' => true,
                'budget_status' => BudgetStatusEnum::Pending->value,
                'budget_amount' => $data->estimatedBudget,
                'budget_details' => $data->budgetDetails ? json_encode($data->budgetDetails) : null,
                'budget_requested_at' => now(),
                'budget_feedback' => null, // Reseta feedback de rejeições anteriores
            ]);

            // Exemplo de disparo de evento no futuro:
            // BudgetSubmitted::dispatch($ticket);

            return $ticket->load(['technician', 'status', 'user']);
        });
    }
}
