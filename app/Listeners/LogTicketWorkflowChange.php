<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\TicketStatusChanged;
use App\Models\TicketStatus;
use App\Models\TicketWorkflowHistory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Throwable;

final class LogTicketWorkflowChange implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * The maximum number of times the listener may be attempted on the queue.
     */
    public int $tries = 3;

    public function handle(TicketStatusChanged $event): void
    {
        $originStatusId = TicketStatus::where('name', $event->oldStatus->value)->value('id');
        $destinationStatusId = TicketStatus::where('name', $event->newStatus->value)->value('id');

        TicketWorkflowHistory::create([
            'ticket_id' => $event->ticket->id,
            'origin_status_id' => $originStatusId,
            'destination_status_id' => $destinationStatusId,
            'technician_id' => $event->changedBy !== null ? $event->changedBy->id : auth()->id(),
            'comment' => "Status changed from \"{$event->oldStatus->value}\" to \"{$event->newStatus->value}\".",
        ]);
    }

    /**
     * Logs the failure when the workflow history write fails.
     */
    public function failed(TicketStatusChanged $event, Throwable $exception): void
    {
        Log::error('Failed to log ticket workflow change to history', [
            'ticket_id' => $event->ticket->id,
            'error' => $exception->getMessage(),
        ]);
    }
}
