<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\TicketStatusUpdatedBroadcast;
use App\Models\User;
use App\Notifications\NewTicketNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Throwable;

final class NotifyAssignedTechnician implements ShouldQueue
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

        if (! $ticket->assigned_to) {
            return;
        }

        /** @var User|null $technician */
        $technician = $ticket->technician;

        if ($technician instanceof User && $technician->email) {
            $technician->notify(new NewTicketNotification($ticket));
        }
    }

    /**
     * Regista o aviso no log caso o envio da notificação falhe após todas as tentativas.
     */
    public function failed(TicketStatusUpdatedBroadcast $event, Throwable $exception): void
    {
        Log::warning('Failed to notify assigned technician', [
            'ticket_id' => $event->ticket->id,
            'assigned_to' => $event->ticket->assigned_to,
            'error' => $exception->getMessage(),
        ]);
    }
}
