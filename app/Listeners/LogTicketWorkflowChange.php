<?php

namespace App\Listeners;

use App\Events\TicketStatusChanged;
use App\Models\TicketWorkflowHistory;

final readonly class LogTicketWorkflowChange
{
    public function handle(TicketStatusChanged $event): void
    {
        TicketWorkflowHistory::create([
            'ticket_id' => $event->ticket->id,
            'old_status' => $event->oldStatus,
            'new_status' => $event->newStatus,
            'changed_at' => now(),
        ]);
    }
}
