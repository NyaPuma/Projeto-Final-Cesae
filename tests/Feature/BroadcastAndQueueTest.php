<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Ticket;
use App\Events\TicketCreatedBroadcast;
use App\Events\TicketStatusUpdatedBroadcast;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BroadcastAndQueueTest extends TestCase
{
    use RefreshDatabase;

    public function test_ticket_created_broadcast_event_dispatches_proper_payload()
    {
        Event::fake([TicketCreatedBroadcast::class]);

        $user = User::factory()->create();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);

        event(new TicketCreatedBroadcast($ticket));

        Event::assertDispatched(TicketCreatedBroadcast::class, function ($event) use ($ticket) {
            return $event->ticket->id === $ticket->id &&
                   $event->broadcastOn()[0]->name === 'tickets' &&
                   $event->broadcastAs() === 'ticket.created';
        });
    }

    public function test_ticket_status_updated_broadcast_event_dispatches_proper_payload()
    {
        Event::fake([TicketStatusUpdatedBroadcast::class]);

        $ticket = Ticket::factory()->create();

        event(new TicketStatusUpdatedBroadcast($ticket, 'Aberto', 'Em Curso'));

        Event::assertDispatched(TicketStatusUpdatedBroadcast::class, function ($event) use ($ticket) {
            return $event->ticket->id === $ticket->id &&
                   $event->oldStatus === 'Aberto' &&
                   $event->newStatus === 'Em Curso' &&
                   $event->broadcastAs() === 'ticket.status.updated';
        });
    }
}
