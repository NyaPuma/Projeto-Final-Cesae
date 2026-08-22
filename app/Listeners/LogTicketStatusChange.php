<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\TicketStatusUpdatedBroadcast;
use App\Models\TicketStatus;
use App\Models\TicketWorkflowHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Throwable;

final class LogTicketStatusChange implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The maximum number of times the listener may be attempted on the queue.
     */
    public int $tries = 3;

    public function handle(TicketStatusUpdatedBroadcast $event): void
    {
        $ticket = $event->ticket;

        $oldStatus = $event->oldStatus->value;
        $newStatus = $event->newStatus->value;

        // Fetch both statuses in a single database query
        $statuses = TicketStatus::whereIn('name', [$oldStatus, $newStatus])
            ->get()
            ->keyBy('name');

        $originStatus = $statuses->get($oldStatus);
        $destinationStatus = $statuses->get($newStatus);

        if (! $originStatus || ! $destinationStatus) {
            Log::warning('Could not resolve status IDs for workflow history', [
                'ticket_id' => $ticket->id,
                'old_status' => $oldStatus,
                'new_status' => $newStatus,
            ]);

            return;
        }

        TicketWorkflowHistory::create([
            'ticket_id' => $ticket->id,
            'origin_status_id' => $originStatus->id,
            'destination_status_id' => $destinationStatus->id,
            'technician_id' => $ticket->assigned_to,
            'comment' => "Status changed from \"{$oldStatus}\" to \"{$newStatus}\".",
        ]);
    }

    /**
     * Handles listener failure when the workflow history write fails.
     */
    public function failed(TicketStatusUpdatedBroadcast $event, Throwable $exception): void
    {
        Log::warning('Failed to log ticket status change to workflow history', [
            'ticket_id' => $event->ticket->id,
            'error' => $exception->getMessage(),
        ]);
    }
}
