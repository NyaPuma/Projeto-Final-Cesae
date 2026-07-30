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

final readonly class TicketCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public CarbonImmutable $createdAt;

    public function __construct(
        public Ticket $ticket,
        public User $creator,
        ?CarbonImmutable $createdAt = null,
    ) {
        $this->createdAt = $createdAt ?? CarbonImmutable::now();
    }

    /**
     * Os canais onde o evento deve ser transmitido em tempo real (WebSockets).
     *
     * @return array<\Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("users.{$this->creator->id}"),
            new PrivateChannel('tickets.admin'),
        ];
    }

    /**
     * Nome do evento emitido para o frontend (Laravel Echo).
     */
    public function broadcastAs(): string
    {
        return 'ticket.created';
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
            'code' => $this->ticket->code ?? null,
            'title' => $this->ticket->title ?? $this->ticket->name ?? null,
            'status' => [
                'value' => $this->ticket->status?->value ?? null,
                'label' => $this->ticket->status?->label() ?? null,
                'color' => $this->ticket->status?->color() ?? null,
            ],
            'priority' => [
                'value' => $this->ticket->priority?->value ?? null,
                'label' => $this->ticket->priority?->label() ?? null,
                'color' => $this->ticket->priority?->color() ?? null,
            ],
            'creator' => [
                'id' => $this->creator->id,
                'name' => $this->creator->name,
                'email' => $this->creator->email,
            ],
            'created_at' => $this->createdAt->toIso8601String(),
        ];
    }
}
