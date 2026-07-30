<?php

namespace App\Enums;

enum TicketWorkflowStatusEnum: string
{
    case Open = 'open';
    case InProgress = 'in_progress';
    case WaitingBudget = 'waiting_budget';
    case Approved = 'approved';
    case Rejected = 'rejected';
    case Closed = 'closed';
    case Cancelled = 'cancelled';

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }

    public function label(): string
    {
        return match ($this) {
            self::Open => 'Aberto',
            self::InProgress => 'Em Curso',
            self::WaitingBudget => 'Pendente de Orçamento',
            self::Approved => 'Aprovado',
            self::Rejected => 'Recusado',
            self::Closed => 'Fechado',
            self::Cancelled => 'Cancelado',
        };
    }
}
