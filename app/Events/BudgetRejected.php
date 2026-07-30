<?php

namespace App\Events;

use App\Models\Ticket;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final readonly class BudgetRejected implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public CarbonImmutable $rejectedAt;

    public function __construct(
        public Ticket $ticket,
        public User $rejectedBy,
        public ?string $feedback = null,
        ?CarbonImmutable $rejectedAt = null,
    ) {
        $this->rejectedAt = $rejectedAt ?? CarbonImmutable::now();
    }

    /**
     * Os canais onde o evento deve ser transmitido em tempo real (WebSockets).
     *
     * @return array<\Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("tickets.{$this->ticket->id}"),
            new PrivateChannel("users.{$this->ticket->user_id}"),
        ];
    }

    /**
     * Nome do evento emitido para o frontend (Laravel Echo).
     */
    public function broadcastAs(): string
    {
        return 'budget.rejected';
    }

    /**
     * Payload otimizado e seguro para envio via WebSocket.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'ticket_id' => $this->ticket->id,
            'rejected_by' => [
                'id' => $this->rejectedBy->id,
                'name' => $this->rejectedBy->name,
            ],
            'feedback' => $this->feedback,
            'rejected_at' => $this->rejectedAt->toIso8601String(),
        ];
    }
}
