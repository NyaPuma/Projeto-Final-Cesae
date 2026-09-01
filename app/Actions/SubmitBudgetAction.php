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
        if ($ticket->hasStatus(TicketStatusEnum::Closed)) {
            throw new InvalidArgumentException('Cannot submit a budget for a ticket that is already closed.');
        }

        if ($ticket->budget_status === BudgetStatusEnum::Pending->value) {
            throw new InvalidArgumentException('A pending budget request already exists for this ticket.');
        }

        if ($data->estimatedBudget <= 0) {
            throw new InvalidArgumentException('The budget amount must be greater than 0.');
        }

        return DB::transaction(function () use ($ticket, $data) {
            $ticket->update([
                'budget_requested' => true,
                'budget_status' => BudgetStatusEnum::Pending->value,
                'budget_amount' => $data->estimatedBudget,
                'budget_details' => $data->budgetDetails ? json_encode($data->budgetDetails) : null,
                'budget_requested_at' => now(),
                'budget_feedback' => null,
            ]);

            return $ticket->load(['technician', 'status', 'user']);
        });
    }
}
