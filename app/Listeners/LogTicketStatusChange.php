<?php

namespace App\Listeners;

use App\Events\TicketStatusUpdatedBroadcast;
use App\Models\TicketStatus;
use App\Models\TicketWorkflowHistory;
use Illuminate\Support\Facades\Log;

class LogTicketStatusChange
{
    public function handle(TicketStatusUpdatedBroadcast $event): void
    {
        try {
            $ticket = $event->ticket;

            $originStatus = TicketStatus::where('name', $event->oldStatus)->first();
            $destinationStatus = TicketStatus::where('name', $event->newStatus)->first();

            if (! $originStatus || ! $destinationStatus) {
                Log::warning('Could not resolve status IDs for workflow history', [
                    'ticket_id' => $ticket->id,
                    'old_status' => $event->oldStatus,
                    'new_status' => $event->newStatus,
                ]);

                return;
            }

            TicketWorkflowHistory::create([
                'ticket_id' => $ticket->id,
                'origin_status_id' => $originStatus->id,
                'destination_status_id' => $destinationStatus->id,
                'technician_id' => $ticket->assigned_to,
                'comment' => "Status changed from \"{$event->oldStatus}\" to \"{$event->newStatus}\".",
            ]);
        } catch (\Throwable $e) {
            Log::warning('Failed to log ticket status change to workflow history', [
                'ticket_id' => $event->ticket->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
