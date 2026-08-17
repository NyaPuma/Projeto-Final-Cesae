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

    /**
     * Retorna todos os valores raw do Enum num array simples.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Retorna a descrição legível em Português para a UI.
     */
    public function label(): string
    {
        return match ($this) {
            self::Open => __('tickets.Aberto'),
            self::InProgress => __('common.Em Curso'),
            self::WaitingBudget => __('common.Pendente de Orçamento'),
            self::Approved => __('common.Aprovado'),
            self::Rejected => __('common.Recusado'),
            self::Closed => __('tickets.Fechado'),
            self::Cancelled => __('tickets.Cancelado'),
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
            self::WaitingBudget => 'warning',
            self::Approved => 'success',
            self::Rejected, self::Cancelled => 'danger',
            self::Closed => 'gray',
        };
    }

    /**
     * Ícone indicativo para representação visual no frontend.
     */
    public function icon(): string
    {
        return match ($this) {
            self::Open => 'heroicon-o-sparkles',
            self::InProgress => 'heroicon-o-play',
            self::WaitingBudget => 'heroicon-o-clock',
            self::Approved => 'heroicon-o-check-circle',
            self::Rejected => 'heroicon-o-x-circle',
            self::Closed => 'heroicon-o-archive-box',
            self::Cancelled => 'heroicon-o-ban',
        };
    }

    /**
     * Indica se o estado atual é terminal (fim do workflow).
     */
    public function isFinal(): bool
    {
        return match ($this) {
            self::Closed, self::Cancelled, self::Rejected => true,
            self::Open, self::InProgress, self::WaitingBudget, self::Approved => false,
        };
    }

    /**
     * Indica se o ticket se encontra num estado ativo no workflow.
     */
    public function isActive(): bool
    {
        return ! $this->isFinal();
    }

    /**
     * Define as transições válidas a partir do estado atual.
     *
     * @return array<self>
     */
    public function allowedTransitions(): array
    {
        return match ($this) {
            self::Open => [self::InProgress, self::WaitingBudget, self::Cancelled],
            self::InProgress => [self::WaitingBudget, self::Approved, self::Closed, self::Cancelled],
            self::WaitingBudget => [self::Approved, self::Rejected, self::Cancelled],
            self::Approved => [self::InProgress, self::Closed, self::Cancelled],
            self::Rejected => [self::WaitingBudget, self::Cancelled],
            self::Closed, self::Cancelled => [], // Estados finais não aceitam transições diretas
        };
    }

    /**
     * Verifica se é possível transitar do estado atual para um novo estado pretendido.
     */
    public function canTransitionTo(self $target): bool
    {
        return in_array($target, $this->allowedTransitions(), true);
    }

    /**
     * Converte com segurança entradas genéricas (strings sanitizadas ou objetos).
     */
    public static function normalize(mixed $value): ?self
    {
        if ($value instanceof self) {
            return $value;
        }

        if (!is_string($value)) {
            return null;
        }

        return self::tryFrom(mb_strtolower(trim($value)));
    }
}
