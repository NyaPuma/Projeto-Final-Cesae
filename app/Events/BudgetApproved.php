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

final readonly class BudgetApproved implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public CarbonImmutable $approvedAt;

    public function __construct(
        public Ticket $ticket,
        public User $approvedBy,
        public float $amount,
        public bool $isAutoApproved = false,
        ?CarbonImmutable $approvedAt = null,
    ) {
        $this->approvedAt = $approvedAt ?? CarbonImmutable::now();
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
        return 'budget.approved';
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
            'amount' => $this->amount,
            'formatted_amount' => number_format($this->amount, 2, ',', '.') . ' €',
            'approved_by' => [
                'id' => $this->approvedBy->id,
                'name' => $this->approvedBy->name,
            ],
            'is_auto_approved' => $this->isAutoApproved,
            'approved_at' => $this->approvedAt->toIso8601String(),
        ];
    }
}
