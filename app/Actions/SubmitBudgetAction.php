<?php

namespace App\Actions;

use App\DTOs\BudgetSubmissionData;
use App\Enums\BudgetStatusEnum;
use App\Models\Ticket;

final readonly class SubmitBudgetAction
{
    public function execute(Ticket $ticket, BudgetSubmissionData $data): Ticket
    {
        $ticket->update([
            'budget_requested' => true,
            'budget_status' => BudgetStatusEnum::Pending->value,
            'budget_amount' => $data->amount,
            'budget_details' => $data->details,
            'budget_requested_at' => now(),
        ]);

        return $ticket;
    }
}
