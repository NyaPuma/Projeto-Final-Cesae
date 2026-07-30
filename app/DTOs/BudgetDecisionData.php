<?php

namespace App\DTOs;

use App\Enums\BudgetDecisionEnum;
use Illuminate\Foundation\Http\FormRequest;

final readonly class BudgetDecisionData
{
    public function __construct(
        public BudgetDecisionEnum $decision,
        public ?string $feedback = null,
    ) {}

    /**
     * Cria o DTO a partir de um Array ou FormRequest.
     */
    public static function fromRequest(FormRequest|array $data): self
    {
        $payload = $data instanceof FormRequest ? $data->validated() : $data;

        // Aceita 'decision' ou fallback para 'action'
        $rawDecision = $payload['decision'] ?? $payload['action'] ?? null;

        if ($rawDecision === null) {
            $decision = BudgetDecisionEnum::Approve;
        } else {
            $decision = $rawDecision instanceof BudgetDecisionEnum
                ? $rawDecision
                : BudgetDecisionEnum::from($rawDecision);
        }

        // Sanitiza o feedback: limpa espaços e converte strings vazias para null
        $rawFeedback = isset($payload['feedback']) ? trim((string) $payload['feedback']) : null;
        $feedback = $rawFeedback !== '' ? $rawFeedback : null;

        return new self(
            decision: $decision,
            feedback: $feedback,
        );
    }

    /**
     * Converte o DTO para array simples.
     */
    public function toArray(): array
    {
        return [
            'decision' => $this->decision->value,
            'feedback' => $this->feedback,
        ];
    }

    /**
     * Métodos auxiliares de conveniência para lógica de negócio.
     */
    public function isApproved(): bool
    {
        return $this->decision === BudgetDecisionEnum::Approve;
    }

    public function isRejected(): bool
    {
        return $this->decision === BudgetDecisionEnum::Reject;
    }
}
