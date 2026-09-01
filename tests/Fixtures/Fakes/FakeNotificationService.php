<?php

namespace Tests\Fixtures\Fakes;

class FakeNotificationService
{
    private array $notifications = [];

    public function __construct()
    {
    }

    public function notifyBudgetDecision($ticket, string $decision, string $message): void
    {
        $this->notifications[] = [
            'type' => 'budget_decision',
            'ticket_id' => $ticket->id,
            'decision' => $decision,
            'message' => $message,
        ];
    }

    public function notifyTicketCreated($ticket): void
    {
        $this->notifications[] = [
            'type' => 'ticket_created',
            'ticket_id' => $ticket->id,
        ];
    }

    public function notifyTicketStatusChanged($ticket, string $oldStatus, string $newStatus): void
    {
        $this->notifications[] = [
            'type' => 'status_changed',
            'ticket_id' => $ticket->id,
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
        ];
    }

    public function getNotifications(): array
    {
        return $this->notifications;
    }

    public function hasNotification(string $type): bool
    {
        foreach ($this->notifications as $notification) {
            if ($notification['type'] === $type) {
                return true;
            }
        }

        return false;
    }

    public function clear(): void
    {
        $this->notifications = [];
    }
}
