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
     * O número de vezes que o listener pode ser tentado na fila.
     */
    public int $tries = 3;

    /**
     * Intervalo de espera (em segundos) entre as tentativas.
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
     * Regista a falha no log caso o envio da notificação falhe em todas as tentativas.
     */
    public function failed(TicketCreated $event, Throwable $exception): void
    {
        Log::error('Failed to send new ticket notification to admins', [
            'ticket_id' => $event->ticket->id,
            'error' => $exception->getMessage(),
        ]);
    }
}
