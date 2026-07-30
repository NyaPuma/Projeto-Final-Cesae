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
            throw new \InvalidArgumentException('O valor estimado do orçamento não pode ser negativo.');
        }
    }

    /**
     * Construtor para estimativa simples de orçamento.
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
     * Construtor para pedido detalhado de orçamento.
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
     * Sanitiza a entrada monetária para float preciso (2 casas decimais).
     */
    private static function parseAmount(mixed $value): float
    {
        if (is_numeric($value)) {
            return round((float) $value, 2);
        }

        // Caso venha formatado como string "150,50" -> converte vírgula para ponto
        if (is_string($value)) {
            $cleaned = str_replace(',', '.', preg_replace('/[^\d,.]/', '', $value));

            if (is_numeric($cleaned)) {
                return round((float) $cleaned, 2);
            }
        }

        return 0.0;
    }

    /**
     * Converte o DTO para array pronto a utilizar no Eloquent.
     */
    public function toArray(): array
    {
        return [
            'estimated_budget' => $this->estimatedBudget,
            'budget_details' => $this->budgetDetails,
            'is_detailed_request' => $this->isDetailedRequest,
        ];
    }
}
