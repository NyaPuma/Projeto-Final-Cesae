<?php

namespace App\Observers;

use App\Events\TicketCreated;
use App\Events\TicketStatusChanged;
use App\Models\Ticket;
use App\Models\User;

final readonly class TicketObserver
{
    public function created(Ticket $ticket): void
    {
        if ($ticket->user && $ticket->user instanceof User) {
            event(new TicketCreated($ticket, $ticket->user));
        }
    }

    public function updated(Ticket $ticket): void
    {
        if ($ticket->wasChanged('status_id') && $ticket->getOriginal('status_id')) {
            event(new TicketStatusChanged(
                $ticket,
                (string) $ticket->getOriginal('status_id'),
                (string) $ticket->status_id,
            ));
        }
    }
}
