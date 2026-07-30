<?php

declare(strict_types=1);

namespace App\Enums;

enum BudgetDecisionEnum: string
{
    case Approve = 'approve';
    case Reject = 'reject';

    public function label(): string
    {
        return match ($this) {
            self::Approve => 'Aprovar',
            self::Reject => 'Rejeitar',
        };
    }

    public function isFinal(): bool
    {
        return true;
    }
}
