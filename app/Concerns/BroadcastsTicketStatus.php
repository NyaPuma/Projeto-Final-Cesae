<?php

namespace App\Concerns;

use App\Enums\TicketStatusEnum;
use App\Events\TicketStatusUpdatedBroadcast;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketStatusChanged;
use Illuminate\Support\Facades\Log;

trait BroadcastsTicketStatus
{
    protected function broadcastStatusChange(Ticket $ticket, string $oldStatus, TicketStatusEnum $newStatus): void
    {
        try {
            event(new TicketStatusUpdatedBroadcast($ticket, $oldStatus, $newStatus->value));

            /** @var User|null $user */
            $user = $ticket->relationLoaded('user') ? $ticket->user : $ticket->user()->first();

            if ($user instanceof User && $user->email) {
                $user->notify(new TicketStatusChanged($ticket, $oldStatus, $newStatus->value));
            }
        } catch (\Throwable $e) {
            Log::warning('Failed to broadcast ticket status change', [
                'ticket_id' => $ticket->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
