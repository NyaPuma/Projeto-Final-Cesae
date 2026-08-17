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
     * O número de vezes que o listener pode ser tentado na fila.
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
            'technician_id' => $event->changedBy?->id ?? auth()->id(),
            'comment' => "Status changed from \"{$event->oldStatus->value}\" to \"{$event->newStatus->value}\".",
        ]);
    }

    /**
     * Regista a falha no log caso a gravação do histórico falhe.
     */
    public function failed(TicketStatusChanged $event, Throwable $exception): void
    {
        Log::error('Failed to log ticket workflow change to history', [
            'ticket_id' => $event->ticket->id,
            'error' => $exception->getMessage(),
        ]);
    }
}
