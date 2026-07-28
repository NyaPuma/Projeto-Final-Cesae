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

    public function icon(): string
    {
        return match ($this) {
            self::BudgetRequest => '💰',
            self::BudgetSubmitted => '📋',
            self::BudgetApproved => '✅',
            self::BudgetRejected => '❌',
            self::BudgetAutoApproved => '✅',
            self::TicketClosed => '🔧',
            self::TicketCreated => '🎫',
            self::PriorityOverride => '⚠️',
        };
    }
}
