<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\TicketCreatedBroadcast;
use App\Events\TicketStatusUpdatedBroadcast;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Throwable;

final class BroadcastTicketUpdate implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * O número de vezes que o listener pode ser tentado na fila.
     */
    public int $tries = 3;

    public function handle(TicketCreatedBroadcast $event): void
    {
        // A notificação ao técnico atribuído é agora feita diretamente
        // pelo TicketCreatedBroadcast::broadcastOn().
        // Este listener mantém-se para garantir compatibilidade com o
        // EventServiceProvider e para futuras extensões.
    }

    /**
     * Trata o insucesso do Listener caso o serviço de WebSockets/Broadcast esteja indisponível.
     */
    public function failed(TicketCreatedBroadcast $event, Throwable $exception): void
    {
        Log::warning('Failed to broadcast ticket creation to assigned technician', [
            'ticket_id' => $event->ticket->id,
            'error' => $exception->getMessage(),
        ]);
    }
}
