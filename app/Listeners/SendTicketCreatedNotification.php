<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\TicketCreated;
use App\Services\NotificationService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Throwable;

final class SendTicketCreatedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The maximum number of times the listener may be attempted on the queue.
     */
    public int $tries = 3;

    /**
     * Wait time (in seconds) between attempts.
     *
     * @var array<int, int>
     */
    public array $backoff = [5, 15, 30];

    public function __construct(
        private readonly NotificationService $notificationService,
    ) {}

    public function handle(TicketCreated $event): void
    {
        $this->notificationService->notifyTicketCreated($event->ticket);
    }

    /**
     * Logs the failure when notification delivery fails after all attempts.
     */
    public function failed(TicketCreated $event, Throwable $exception): void
    {
        Log::error('Failed to send new ticket notification to admins', [
            'ticket_id' => $event->ticket->id,
            'error' => $exception->getMessage(),
        ]);
    }
}
