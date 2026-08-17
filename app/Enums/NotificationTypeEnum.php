<?php

namespace App\Enums;

enum NotificationTypeEnum: string
{
    case BudgetRequest = 'budget_request';
    case BudgetSubmitted = 'budget_submitted';
    case BudgetApproved = 'budget_approved';
    case BudgetRejected = 'budget_rejected';
    case BudgetAutoApproved = 'budget_auto_approved';
    case TicketClosed = 'ticket_closed';
    case TicketCreated = 'ticket_created';
    case PriorityOverride = 'priority_override';
    case LowStock = 'low_stock';

    /**
     * Retorna todos os valores raw do Enum num array simples.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Retorna a descrição legível em Português para a UI e e-mails.
     */
    public function label(): string
    {
        return match ($this) {
            self::BudgetRequest => __('common.Pedido de Orçamento'),
            self::BudgetSubmitted => __('common.Orçamento Submetido'),
            self::BudgetApproved => __('common.Orçamento Aprovado'),
            self::BudgetRejected => __('common.Orçamento Rejeitado'),
            self::BudgetAutoApproved => __('common.Orçamento Aprovado Automaticamente'),
            self::TicketClosed => __('tickets.Ticket Encerrado'),
            self::TicketCreated => __('tickets.Novo Ticket Criado'),
            self::PriorityOverride => __('common.Alteração Manual de Prioridade'),
            self::LowStock => __('stock.Stock Baixo'),
        };
    }

    /**
     * Emoji ou representação gráfica indicativa.
     */
    public function icon(): string
    {
        return match ($this) {
            self::BudgetRequest => '💰',
            self::BudgetSubmitted => '📋',
            self::BudgetApproved, self::BudgetAutoApproved => '✅',
            self::BudgetRejected => '❌',
            self::TicketClosed => '🔧',
            self::TicketCreated => '🎫',
            self::PriorityOverride => '⚠️',
            self::LowStock => '📦',
        };
    }

    /**
     * Cor indicativa para badges/toasts no frontend.
     */
    public function color(): string
    {
        return match ($this) {
            self::BudgetApproved, self::BudgetAutoApproved => 'success',
            self::BudgetRejected, self::PriorityOverride => 'danger',
            self::BudgetRequest, self::BudgetSubmitted => 'warning',
            self::TicketCreated, self::TicketClosed => 'info',
            self::LowStock => 'warning',
        };
    }

    /**
     * Mapeia a prioridade padrão do tipo de notificação.
     */
    public function defaultPriority(): NotificationPriorityEnum
    {
        return match ($this) {
            self::PriorityOverride, self::BudgetRejected => NotificationPriorityEnum::Urgent,
            self::BudgetRequest, self::BudgetSubmitted => NotificationPriorityEnum::High,
            self::BudgetApproved, self::BudgetAutoApproved, self::TicketCreated => NotificationPriorityEnum::Normal,
            self::TicketClosed => NotificationPriorityEnum::Low,
            self::LowStock => NotificationPriorityEnum::High,
        };
    }

    /**
     * Indica se a notificação está relacionada com o módulo de orçamentos.
     */
    public function isBudgetRelated(): bool
    {
        return match ($this) {
            self::BudgetRequest,
            self::BudgetSubmitted,
            self::BudgetApproved,
            self::BudgetRejected,
            self::BudgetAutoApproved => true,
            default => false,
        };
    }

    /**
     * Tenta converter um valor genérico (string ou Enum) de forma segura.
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
