<?php

namespace App\Events;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use Carbon\CarbonImmutable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class TicketStatusUpdatedBroadcast implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public TicketStatusEnum $oldStatus;
    public TicketStatusEnum $newStatus;
    public CarbonImmutable $broadcastedAt;

    public function __construct(
        public Ticket $ticket,
        TicketStatusEnum|string $oldStatus,
        TicketStatusEnum|string $newStatus,
        ?CarbonImmutable $broadcastedAt = null,
    ) {
        $this->oldStatus = $oldStatus instanceof TicketStatusEnum
            ? $oldStatus
            : (TicketStatusEnum::normalize($oldStatus) ?? TicketStatusEnum::Open);

        $this->newStatus = $newStatus instanceof TicketStatusEnum
            ? $newStatus
            : (TicketStatusEnum::normalize($newStatus) ?? TicketStatusEnum::Open);

        $this->broadcastedAt = $broadcastedAt ?? CarbonImmutable::now();
    }

    /**
     * Os canais privados onde o evento deve ser transmitido imediatamente.
     *
     * @return array<\Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel("tickets.{$this->ticket->id}"),
            new PrivateChannel("users.{$this->ticket->user_id}"),
            new PrivateChannel('tickets.admin'),
        ];
    }

    /**
     * Nome do evento emitido para o frontend (Laravel Echo).
     */
    public function broadcastAs(): string
    {
        return 'ticket.status.updated';
    }

    /**
     * Payload completo com cores e rótulos para renderização imediata na UI.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'id' => $this->ticket->id,
            'code' => $this->ticket->code ?? null,
            'title' => $this->ticket->title,
            'old_status' => [
                'value' => $this->oldStatus->value,
                'label' => $this->oldStatus->label(),
                'color' => $this->oldStatus->color(),
            ],
            'new_status' => [
                'value' => $this->newStatus->value,
                'label' => $this->newStatus->label(),
                'color' => $this->newStatus->color(),
            ],
            'is_final' => $this->newStatus->isFinal(),
            'updated_at' => $this->broadcastedAt->toIso8601String(),
        ];
    }
}
