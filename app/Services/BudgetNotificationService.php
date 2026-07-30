<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\NotificationTypeEnum;
use App\Models\Ticket;

final class BudgetNotificationService
{
    /**
     * @param NotificationCreatorService $creator
     */
    public function __construct(
        private readonly NotificationCreatorService $creator,
    ) {}

    /**
     * Notifica a submissão de um orçamento para administradores e criador do ticket.
     *
     * @param Ticket $ticket
     * @param string $message
     */
    public function notifyBudgetSubmitted(Ticket $ticket, string $message): void
    {
        $this->creator->createForAdmins(
            title: NotificationTypeEnum::BudgetRequest->icon() . " Orçamento Pendente - Ticket #{$ticket->id}",
            message: $message,
            type: NotificationTypeEnum::BudgetRequest->value,
            link: "/ui/tickets/{$ticket->id}",
        );

        if ($ticket->user_id) {
            $this->creator->createForUser(
                userId: $ticket->user_id,
                title: NotificationTypeEnum::BudgetSubmitted->icon() . " Orçamento Submetido - Ticket #{$ticket->id}",
                message: $message,
                type: NotificationTypeEnum::BudgetSubmitted->value,
                link: "/ui/tickets/{$ticket->id}",
            );
        }
    }

    /**
     * Notifica a auto-aprovação de um orçamento para o técnico atribuído e criador do ticket.
     *
     * @param Ticket $ticket
     * @param string $message
     */
    public function notifyBudgetAutoApproved(Ticket $ticket, string $message): void
    {
        if ($ticket->assigned_to) {
            $this->creator->createForUser(
                userId: $ticket->assigned_to,
                title: NotificationTypeEnum::BudgetAutoApproved->icon() . " Auto-Aprovado - Ticket #{$ticket->id}",
                message: $message,
                type: NotificationTypeEnum::BudgetAutoApproved->value,
                link: "/ui/tickets/{$ticket->id}",
            );
        }

        if ($ticket->user_id) {
            $this->creator->createForUser(
                userId: $ticket->user_id,
                title: NotificationTypeEnum::BudgetAutoApproved->icon() . " Orçamento Auto-Aprovado - Ticket #{$ticket->id}",
                message: $message,
                type: NotificationTypeEnum::BudgetAutoApproved->value,
                link: "/ui/tickets/{$ticket->id}",
            );
        }
    }

    /**
     * Notifica a decisão sobre um orçamento (aprovado ou rejeitado).
     *
     * @param Ticket $ticket
     * @param string $decision
     * @param string $message
     */
    public function notifyBudgetDecision(Ticket $ticket, string $decision, string $message): void
    {
        $type = $decision === 'approve' ? NotificationTypeEnum::BudgetApproved : NotificationTypeEnum::BudgetRejected;
        $icon = $type->icon();

        if ($ticket->assigned_to) {
            $label = $decision === 'approve' ? 'Aprovado' : 'Recusado';
            $this->creator->createForUser(
                userId: $ticket->assigned_to,
                title: "{$icon} Orçamento {$label} - Ticket #{$ticket->id}",
                message: $message,
                type: $type->value,
                link: "/ui/tickets/{$ticket->id}",
            );
        }

        if ($ticket->user_id) {
            $this->creator->createForUser(
                userId: $ticket->user_id,
                title: "{$icon} Decisão Orçamental - Ticket #{$ticket->id}",
                message: $message,
                type: $type->value,
                link: "/ui/tickets/{$ticket->id}",
            );
        }
    }

    /**
     * Notifica a criação de um novo ticket para os administradores.
     *
     * @param Ticket $ticket
     */
    public function notifyTicketCreated(Ticket $ticket): void
    {
        $this->creator->createForAdmins(
            title: NotificationTypeEnum::TicketCreated->icon() . " Novo Ticket - #{$ticket->id}",
            message: "Novo ticket criado: {$ticket->title}",
            type: NotificationTypeEnum::TicketCreated->value,
            link: "/ui/tickets/{$ticket->id}",
        );
    }
}
