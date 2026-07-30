<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\TicketStatusUpdatedBroadcast;
use App\Models\User;
use App\Notifications\TicketStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Throwable;

final class SendTicketStatusNotification implements ShouldQueue
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

    public function handle(TicketStatusUpdatedBroadcast $event): void
    {
        $ticket = $event->ticket;

        /** @var User|null $user */
        $user = $ticket->user;

        if ($user instanceof User && $user->email) {
            $user->notify(new TicketStatusChanged(
                $ticket,
                $event->oldStatus,
                $event->newStatus
            ));
        }
    }

    /**
     * Regista a falha no log caso o envio da notificação falhe após todas as tentativas.
     */
    public function failed(TicketStatusUpdatedBroadcast $event, Throwable $exception): void
    {
        Log::warning('Failed to send ticket status notification', [
            'ticket_id' => $event->ticket->id,
            'error' => $exception->getMessage(),
        ]);
    }
}
