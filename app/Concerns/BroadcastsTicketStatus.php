<?php

namespace App\Concerns;

use App\Enums\TicketStatusEnum;
use App\Events\TicketStatusUpdatedBroadcast;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketStatusChanged;

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
        } catch (\Exception $e) {
        }
    }
}
