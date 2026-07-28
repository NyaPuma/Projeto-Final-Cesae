<?php

namespace App\Listeners;

use App\Events\TicketCreatedBroadcast;
use App\Events\TicketStatusUpdatedBroadcast;
use App\Models\TicketStatus;
use Illuminate\Support\Facades\Log;

class BroadcastTicketUpdate
{
    public function handle(TicketCreatedBroadcast $event): void
    {
        try {
            $ticket = $event->ticket;

            if (! $ticket->assigned_to) {
                return;
            }

            $status = TicketStatus::find($ticket->status_id);
            $statusName = $status->name ?? 'unknown';

            broadcast(new TicketStatusUpdatedBroadcast(
                $ticket,
                $statusName,
                $statusName,
            ));
        } catch (\Throwable $e) {
            Log::warning('Failed to broadcast ticket creation to assigned technician', [
                'ticket_id' => $event->ticket->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
