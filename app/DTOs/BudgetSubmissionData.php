<?php

namespace App\DTOs;

final readonly class BudgetSubmissionData
{
    public function __construct(
        public float $estimatedBudget,
        public ?array $budgetDetails = null,
        public bool $isDetailedRequest = false,
    ) {}

    public static function fromSubmitEstimate(array $data): self
    {
        return new self(
            estimatedBudget: (float) ($data['estimatedBudget'] ?? 0),
            budgetDetails: $data['budget_details'] ?? null,
            isDetailedRequest: false,
        );
    }

    public static function fromDetailedRequest(array $data): self
    {
        return new self(
            estimatedBudget: (float) ($data['budget_amount'] ?? 0),
            budgetDetails: $data['budget_details'] ?? null,
            isDetailedRequest: true,
        );
    }
}
