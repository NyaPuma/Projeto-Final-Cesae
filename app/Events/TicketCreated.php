<?php

namespace App\Events;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class TicketCreated implements ShouldBroadcast
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
     * The channels on which the event should be broadcast in real time (WebSockets).
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
     * The event name emitted to the frontend (Laravel Echo).
     */
    public function broadcastAs(): string
    {
        return 'ticket.created';
    }

    /**
     * Optimized and safe payload for WebSocket transmission.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        $statusEnum = $this->ticket->status ? TicketStatusEnum::tryFrom($this->ticket->status->name) : null;
        $priorityEnum = is_string($this->ticket->priority) ? TicketPriorityEnum::tryFrom($this->ticket->priority) : null;

        return [
            'ticket_id' => $this->ticket->id,
            'code' => $this->ticket->status?->code ?? null,
            'title' => $this->ticket->title ?? $this->ticket->name ?? null,
            'status' => [
                'value' => $statusEnum?->value ?? null,
                'label' => $statusEnum?->label() ?? null,
                'color' => $statusEnum?->color() ?? null,
            ],
            'priority' => [
                'value' => $priorityEnum?->value ?? null,
                'label' => $priorityEnum?->label() ?? null,
                'color' => $priorityEnum?->color() ?? null,
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
