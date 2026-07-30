<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\TicketStatusChanged;
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
        TicketWorkflowHistory::create([
            'ticket_id' => $event->ticket->id,
            'old_status' => $event->oldStatus,
            'new_status' => $event->newStatus,
            'changed_by_user_id' => $event->changedBy?->id ?? auth()->id(),
            'changed_at' => now(),
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
