<?php

namespace App\Listeners;

use App\Events\TicketCreated;
use App\Services\NotificationService;

final readonly class SendTicketCreatedNotification
{
    public function __construct(
        private readonly NotificationService $notificationService,
    ) {}

    public function handle(TicketCreated $event): void
    {
        // Notify admins about new ticket
        // Implementation depends on notification requirements
        $this->notificationService->notifyTicketCreated($event->ticket);
    }
}
