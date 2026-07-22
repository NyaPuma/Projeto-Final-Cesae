<?php

namespace App\Events;

use App\Models\Ticket;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class TicketCreatedBroadcast implements ShouldBroadcastNow
{
    use Dispatchable, SerializesModels;

    public function __construct(public Ticket $ticket) {}

    public function broadcastOn(): array
    {
        return [new Channel('tickets')];
    }

    public function broadcastAs(): string
    {
        return 'ticket.created';
    }

    public function broadcastWith(): array
    {
        return [
            'id' => $this->ticket->id,
            'title' => $this->ticket->title,
            'status_id' => $this->ticket->status_id,
            'priority' => $this->ticket->priority,
        ];
    }
}
