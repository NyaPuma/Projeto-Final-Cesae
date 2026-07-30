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

final readonly class TechnicianAssigned implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public CarbonImmutable $assignedAt;

    public function __construct(
        public Ticket $ticket,
        public ?User $technician,
        ?CarbonImmutable $assignedAt = null,
    ) {
        $this->assignedAt = $assignedAt ?? CarbonImmutable::now();
    }

    /**
     * Os canais onde o evento deve ser transmitido em tempo real (WebSockets).
     *
     * @return array<\Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        $channels = [
            new PrivateChannel("tickets.{$this->ticket->id}"),
            new PrivateChannel("users.{$this->ticket->user_id}"),
        ];

        if ($this->technician !== null) {
            $channels[] = new PrivateChannel("users.{$this->technician->id}");
        }

        return $channels;
    }

    /**
     * Nome do evento emitido para o frontend (Laravel Echo).
     */
    public function broadcastAs(): string
    {
        return 'technician.assigned';
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
            'technician' => $this->technician ? [
                'id' => $this->technician->id,
                'name' => $this->technician->name,
                'email' => $this->technician->email,
            ] : null,
            'is_assigned' => $this->technician !== null,
            'assigned_at' => $this->assignedAt->toIso8601String(),
        ];
    }
}
