<?php

namespace App\Services;

use App\Enums\NotificationTypeEnum;
use App\Models\Notification;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Throwable;

final class NotificationService
{
    public function notifyBudgetSubmitted(Ticket $ticket, string $message): void
    {
        try {
            $this->notifyAdmins(
                title: NotificationTypeEnum::BudgetRequest->icon()." Orçamento Pendente - Ticket #{$ticket->id}",
                message: $message,
                type: NotificationTypeEnum::BudgetRequest->value,
                ticketId: $ticket->id,
            );

            if ($ticket->user_id) {
                $this->notifyUser(
                    userId: $ticket->user_id,
                    title: NotificationTypeEnum::BudgetSubmitted->icon()." Orçamento Submetido - Ticket #{$ticket->id}",
                    message: $message,
                    type: NotificationTypeEnum::BudgetSubmitted->value,
                    ticketId: $ticket->id,
                );
            }
        } catch (Throwable $e) {
            Log::warning('Failed to create notification', ['error' => $e->getMessage()]);
        }
    }

    public function notifyBudgetAutoApproved(Ticket $ticket, string $message): void
    {
        try {
            if ($ticket->assigned_to) {
                $this->notifyUser(
                    userId: $ticket->assigned_to,
                    title: NotificationTypeEnum::BudgetAutoApproved->icon()." Auto-Aprovado - Ticket #{$ticket->id}",
                    message: $message,
                    type: NotificationTypeEnum::BudgetAutoApproved->value,
                    ticketId: $ticket->id,
                );
            }

            if ($ticket->user_id) {
                $this->notifyUser(
                    userId: $ticket->user_id,
                    title: NotificationTypeEnum::BudgetAutoApproved->icon()." Orçamento Auto-Aprovado - Ticket #{$ticket->id}",
                    message: $message,
                    type: NotificationTypeEnum::BudgetAutoApproved->value,
                    ticketId: $ticket->id,
                );
            }
        } catch (Throwable $e) {
            Log::warning('Failed to create notification', ['error' => $e->getMessage()]);
        }
    }

    public function notifyBudgetDecision(Ticket $ticket, string $decision, string $message): void
    {
        try {
            $type = $decision === 'approve' ? NotificationTypeEnum::BudgetApproved : NotificationTypeEnum::BudgetRejected;
            $icon = $type->icon();

            if ($ticket->assigned_to) {
                $label = $decision === 'approve' ? 'Aprovado' : 'Recusado';
                $this->notifyUser(
                    userId: $ticket->assigned_to,
                    title: "{$icon} Orçamento {$label} - Ticket #{$ticket->id}",
                    message: $message,
                    type: $type->value,
                    ticketId: $ticket->id,
                );
            }

            if ($ticket->user_id) {
                $this->notifyUser(
                    userId: $ticket->user_id,
                    title: "{$icon} Decisão Orçamental - Ticket #{$ticket->id}",
                    message: $message,
                    type: $type->value,
                    ticketId: $ticket->id,
                );
            }
        } catch (Throwable $e) {
            Log::warning('Failed to create notification', ['error' => $e->getMessage()]);
        }
    }

    public function notifyTicketClosed(Ticket $ticket, string $message): void
    {
        try {
            if ($ticket->user_id) {
                $this->notifyUser(
                    userId: $ticket->user_id,
                    title: NotificationTypeEnum::TicketClosed->icon()." Ticket Fechado - #{$ticket->id}",
                    message: $message,
                    type: NotificationTypeEnum::TicketClosed->value,
                    ticketId: $ticket->id,
                );
            }
        } catch (Throwable $e) {
            Log::warning('Failed to create notification', ['error' => $e->getMessage()]);
        }
    }

    public function notifyPriorityOverride(Ticket $ticket, User $technician, int $urgentCount): void
    {
        try {
            $admins = User::whereHas('profile', function ($q) {
                $q->where('name', User::ROLE_ADMIN);
            })->get();

            foreach ($admins as $admin) {
                Notification::create([
                    'user_id' => $admin->id,
                    'title' => NotificationTypeEnum::PriorityOverride->icon()." Ticket Não Prioritário - #{$ticket->id}",
                    'message' => "O técnico {$technician->name} iniciou o ticket #{$ticket->id} ({$ticket->title}) com prioridade '{$ticket->priority}', ignorando {$urgentCount} ticket(s) mais urgente(s) pendentes.",
                    'type' => NotificationTypeEnum::PriorityOverride->value,
                    'link' => "/ui/tickets/{$ticket->id}",
                ]);
            }
        } catch (Throwable $e) {
            Log::warning('Failed to create notification', ['error' => $e->getMessage()]);
        }
    }

    private function notifyAdmins(string $title, string $message, string $type, int $ticketId): void
    {
        $admins = User::whereHas('profile', function ($q) {
            $q->where('name', User::ROLE_ADMIN);
        })->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'title' => $title,
                'message' => $message,
                'type' => $type,
                'link' => "/ui/tickets/{$ticketId}",
            ]);
        }
    }

    private function notifyUser(int $userId, string $title, string $message, string $type, int $ticketId): void
    {
        Notification::create([
            'user_id' => $userId,
            'title' => $title,
            'message' => $message,
            'type' => $type,
            'link' => "/ui/tickets/{$ticketId}",
        ]);
    }
}
