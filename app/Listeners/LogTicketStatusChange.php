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
     * O número de vezes que o listener pode ser tentado na fila.
     */
    public int $tries = 3;

    public function handle(TicketStatusUpdatedBroadcast $event): void
    {
        $ticket = $event->ticket;

        // Busca ambos os status numa única consulta ao banco de dados
        $statuses = TicketStatus::whereIn('name', [$event->oldStatus, $event->newStatus])
            ->get()
            ->keyBy('name');

        $originStatus = $statuses->get($event->oldStatus);
        $destinationStatus = $statuses->get($event->newStatus);

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
    }

    /**
     * Trata o insucesso do Listener caso a escrita na tabela de histórico falhe.
     */
    public function failed(TicketStatusUpdatedBroadcast $event, Throwable $exception): void
    {
        Log::warning('Failed to log ticket status change to workflow history', [
            'ticket_id' => $event->ticket->id,
            'error' => $exception->getMessage(),
        ]);
    }
}
