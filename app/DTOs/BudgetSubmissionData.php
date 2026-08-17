<?php

namespace App\DTOs;

use Illuminate\Foundation\Http\FormRequest;

final readonly class BudgetSubmissionData
{
    public function __construct(
        public float $estimatedBudget,
        public ?array $budgetDetails = null,
        public bool $isDetailedRequest = false,
    ) {
        if ($this->estimatedBudget < 0) {
            throw new \InvalidArgumentException('The estimated budget amount cannot be negative.');
        }
    }

    /**
     * Factory for a simple budget estimate submission.
     */
    public static function fromSubmitEstimate(FormRequest|array $data): self
    {
        $payload = $data instanceof FormRequest ? $data->validated() : $data;

        return new self(
            estimatedBudget: self::parseAmount($payload['estimatedBudget'] ?? $payload['estimated_budget'] ?? 0),
            budgetDetails: $payload['budget_details'] ?? null,
            isDetailedRequest: false,
        );
    }

    /**
     * Factory for a detailed budget request.
     */
    public static function fromDetailedRequest(FormRequest|array $data): self
    {
        $payload = $data instanceof FormRequest ? $data->validated() : $data;

        return new self(
            estimatedBudget: self::parseAmount($payload['budget_amount'] ?? 0),
            budgetDetails: $payload['budget_details'] ?? null,
            isDetailedRequest: true,
        );
    }

    /**
     * Sanitize monetary input to a precise float (2 decimal places).
     * Handles both numeric values and strings like "150,50" (comma decimal separator).
     */
    private static function parseAmount(mixed $value): float
    {
        if (is_numeric($value)) {
            return round((float) $value, 2);
        }

        if (is_string($value)) {
            $cleaned = str_replace(',', '.', preg_replace('/[^\d,.]/', '', $value));

            if (is_numeric($cleaned)) {
                return round((float) $cleaned, 2);
            }
        }

        return 0.0;
    }

    public function toArray(): array
    {
        return [
            'estimated_budget' => $this->estimatedBudget,
            'budget_details' => $this->budgetDetails,
            'is_detailed_request' => $this->isDetailedRequest,
        ];
    }
}
