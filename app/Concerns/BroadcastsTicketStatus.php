<?php

namespace App\Concerns;

use App\Enums\TicketStatusEnum;
use App\Events\TicketStatusUpdatedBroadcast;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketStatusChanged;
use Illuminate\Support\Facades\Log;
use Throwable;

trait BroadcastsTicketStatus
{
    /**
     * Transmite a alteração de estado do ticket (WebSockets) e notifica o utilizador.
     */
    protected function broadcastStatusChange(
        Ticket $ticket,
        TicketStatusEnum|string $oldStatus,
        TicketStatusEnum|string $newStatus
    ): void {
        $oldStatusValue = $oldStatus instanceof TicketStatusEnum ? $oldStatus->value : $oldStatus;
        $newStatusValue = $newStatus instanceof TicketStatusEnum ? $newStatus->value : $newStatus;

        try {
            // Dispara evento de WebSockets
            event(new TicketStatusUpdatedBroadcast($ticket, $oldStatusValue, $newStatusValue));

            // Notifica o criador do ticket (o Eloquent resolve o lazy-loading automaticamente)
            /** @var User|null $user */
            $user = $ticket->user;

            if ($user?->email) {
                $user->notify(new TicketStatusChanged($ticket, $oldStatusValue, $newStatusValue));
            }
        } catch (Throwable $e) {
            Log::warning('Falha ao transmitir alteração de estado do ticket.', [
                'ticket_id' => $ticket->id,
                'old_status' => $oldStatusValue,
                'new_status' => $newStatusValue,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
