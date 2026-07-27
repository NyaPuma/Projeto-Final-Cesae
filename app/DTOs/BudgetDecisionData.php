<?php

namespace App\DTOs;

final readonly class BudgetDecisionData
{
    public function __construct(
        public string $decision = 'approve',
        public ?string $feedback = null,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            decision: $data['decision'] ?? $data['action'] ?? 'approve',
            feedback: $data['feedback'] ?? null,
        );
    }
}
