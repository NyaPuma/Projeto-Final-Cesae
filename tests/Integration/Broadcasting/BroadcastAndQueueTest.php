<?php

namespace Tests\Feature;

use App\Enums\TicketStatusEnum;
use App\Events\TicketStatusUpdatedBroadcast;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class BroadcastAndQueueTest extends TestCase
{
    use RefreshDatabase;

    public function test_ticket_status_updated_broadcast_event_dispatches_proper_payload()
    {
        Event::fake([TicketStatusUpdatedBroadcast::class]);

        $ticket = Ticket::factory()->create();

        event(new TicketStatusUpdatedBroadcast($ticket, 'Aberto', 'Em Curso'));

        Event::assertDispatched(TicketStatusUpdatedBroadcast::class, function ($event) use ($ticket) {
            return $event->ticket->id === $ticket->id &&
                   $event->oldStatus === TicketStatusEnum::Open &&
                   $event->newStatus === TicketStatusEnum::InProgress &&
                   $event->broadcastAs() === 'ticket.status.updated';
        });
    }
}
