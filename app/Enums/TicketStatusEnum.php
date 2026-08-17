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

    /**
     * Retorna todos os valores raw do Enum num array simples.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Retorna todos os valores aceites, incluindo variações sem acentuação.
     */
    public static function acceptedValues(): array
    {
        return [
            ...self::values(),
            'pendente orcamento',
        ];
    }

    /**
     * Retorna a descrição legível em Português para a UI.
     */
    public function label(): string
    {
        return match ($this) {
            self::Open => __('common.Aberta'),
            self::InProgress => __('common.Em Curso'),
            self::Closed => __('common.Fechada'),
            self::Cancelled => __('ui.Cancelada'),
            self::PendingBudget => __('common.Pendente Orçamento'),
            self::Rejected => __('common.Recusada'),
        };
    }

    /**
     * Cor indicativa para badges/tabelas no frontend.
     */
    public function color(): string
    {
        return match ($this) {
            self::Open => 'info',
            self::InProgress => 'primary',
            self::PendingBudget => 'warning',
            self::Closed => 'success',
            self::Cancelled, self::Rejected => 'danger',
        };
    }

    /**
     * Ícone indicativo para representação visual na UI.
     */
    public function icon(): string
    {
        return match ($this) {
            self::Open => 'heroicon-o-envelope-open',
            self::InProgress => 'heroicon-o-arrow-path',
            self::PendingBudget => 'heroicon-o-banknotes',
            self::Closed => 'heroicon-o-check-circle',
            self::Cancelled => 'heroicon-o-x-circle',
            self::Rejected => 'heroicon-o-no-symbol',
        };
    }

    /**
     * Indica se o ticket atingiu um estado terminal (encerrado/cancelado/recusado).
     */
    public function isFinal(): bool
    {
        return match ($this) {
            self::Closed, self::Cancelled, self::Rejected => true,
            self::Open, self::InProgress, self::PendingBudget => false,
        };
    }

    /**
     * Indica se o ticket ainda se encontra ativo e em processamento.
     */
    public function isActive(): bool
    {
        return ! $this->isFinal();
    }

    /**
     * Converte com segurança entradas genéricas (com/sem acento, maiúsculas ou objetos).
     */
    public static function normalize(mixed $value): ?self
    {
        if ($value instanceof self) {
            return $value;
        }

        if (!is_string($value)) {
            return null;
        }

        $sanitized = mb_strtolower(trim($value));

        return match ($sanitized) {
            'pendente orçamento', 'pendente orcamento' => self::PendingBudget,
            default => self::tryFrom($sanitized),
        };
    }
}
