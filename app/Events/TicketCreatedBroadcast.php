<?php

namespace App\Events;

use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use Carbon\CarbonImmutable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class TicketCreatedBroadcast implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public CarbonImmutable $broadcastedAt;

    public function __construct(
        public Ticket $ticket,
        ?CarbonImmutable $broadcastedAt = null,
    ) {
        $this->broadcastedAt = $broadcastedAt ?? CarbonImmutable::now();
    }

    /**
     * Os canais privados onde o evento deve ser transmitido em tempo real.
     *
     * @return array<\Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        $channels = [
            new PrivateChannel('tickets.admin'),
            new PrivateChannel("users.{$this->ticket->user_id}"),
        ];

        if ($this->ticket->assigned_to) {
            $channels[] = new PrivateChannel("users.{$this->ticket->assigned_to}");
        }

        return $channels;
    }

    /**
     * Nome do evento emitido para o frontend (Laravel Echo).
     */
    public function broadcastAs(): string
    {
        return 'ticket.created';
    }

    /**
     * Payload otimizado e formatado para renderização imediata no frontend.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        $statusEnum = $this->ticket->status ? TicketStatusEnum::tryFrom($this->ticket->status->name) : null;
        $priorityEnum = is_string($this->ticket->priority) ? TicketPriorityEnum::tryFrom($this->ticket->priority) : null;

        return [
            'id' => $this->ticket->id,
            'code' => $this->ticket->status?->code ?? null,
            'title' => $this->ticket->title,
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
            'creator' => $this->ticket->user ? [
                'id' => $this->ticket->user->id,
                'name' => $this->ticket->user->name,
            ] : null,
            'created_at' => ($this->ticket->created_at ?? $this->broadcastedAt)->toIso8601String(),
        ];
    }
}
