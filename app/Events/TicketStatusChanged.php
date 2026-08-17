<?php

namespace App\Events;

use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class TicketStatusChanged implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public TicketStatusEnum $oldStatus;
    public TicketStatusEnum $newStatus;
    public CarbonImmutable $changedAt;

    public function __construct(
        public Ticket $ticket,
        TicketStatusEnum|string $oldStatus,
        TicketStatusEnum|string $newStatus,
        public ?User $changedBy = null,
        ?CarbonImmutable $changedAt = null,
    ) {
        $this->oldStatus = $oldStatus instanceof TicketStatusEnum
            ? $oldStatus
            : (TicketStatusEnum::normalize($oldStatus) ?? TicketStatusEnum::Open);

        $this->newStatus = $newStatus instanceof TicketStatusEnum
            ? $newStatus
            : (TicketStatusEnum::normalize($newStatus) ?? TicketStatusEnum::Open);

        $this->changedAt = $changedAt ?? CarbonImmutable::now();
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
            new PrivateChannel('tickets.admin'),
        ];
    }

    /**
     * Nome do evento emitido para o frontend (Laravel Echo).
     */
    public function broadcastAs(): string
    {
        return 'ticket.status_changed';
    }

    /**
     * Payload otimizado e rico para consumo imediato no frontend.
     *
     * @return array<string, mixed>
     */
    public function broadcastWith(): array
    {
        return [
            'ticket_id' => $this->ticket->id,
            'code' => $this->ticket->reference ?? null,
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
            'changed_by' => $this->changedBy ? [
                'id' => $this->changedBy->id,
                'name' => $this->changedBy->name,
            ] : null,
            'is_final' => $this->newStatus->isFinal(),
            'changed_at' => $this->changedAt->toIso8601String(),
        ];
    }
}
