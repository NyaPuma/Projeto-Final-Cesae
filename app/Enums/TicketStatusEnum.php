<?php

namespace App\Enums;

enum TicketStatusEnum: string
{
    case Open = 'aberta';
    case InProgress = 'em curso';
    case Closed = 'fechada';
    case Cancelled = 'cancelada';
    case PendingBudget = 'pendente orçamento';
    case Rejected = 'recusada';

    public function label(): string
    {
        return match ($this) {
            self::Open => 'Aberta',
            self::InProgress => 'Em Curso',
            self::Closed => 'Fechada',
            self::Cancelled => 'Cancelada',
            self::PendingBudget => 'Pendente Orçamento',
            self::Rejected => 'Recusada',
        };
    }

    public static function fromValue(string $value): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case;
            }
        }

        return null;
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
