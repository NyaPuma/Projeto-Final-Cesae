<?php

namespace Tests\Unit\Events;

use App\Events\TicketCreatedBroadcast;
use App\Models\Ticket;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\DatabaseTestCase;

class TicketCreatedBroadcastTest extends DatabaseTestCase
{
    #[Test]
    public function it_broadcasts_on_tickets_channel(): void
    {
        $ticket = Ticket::factory()->create();
        $event = new TicketCreatedBroadcast($ticket);

        $channels = $event->broadcastOn();

        $this->assertGreaterThanOrEqual(1, count($channels));
        $this->assertInstanceOf(Channel::class, $channels[0]);
    }

    #[Test]
    public function it_broadcasts_with_correct_event_name(): void
    {
        $ticket = Ticket::factory()->create();
        $event = new TicketCreatedBroadcast($ticket);

        $this->assertEquals('ticket.created', $event->broadcastAs());
    }

    #[Test]
    public function it_broadcasts_with_ticket_data(): void
    {
        $ticket = Ticket::factory()->create([
            'title' => 'Test Ticket',
            'priority' => 'alta',
        ]);

        $event = new TicketCreatedBroadcast($ticket);
        $data = $event->broadcastWith();

        $this->assertEquals($ticket->id, $data['id']);
        $this->assertEquals('Test Ticket', $data['title']);
        $this->assertArrayHasKey('status', $data);
        $this->assertArrayHasKey('priority', $data);
    }

    #[Test]
    public function it_implements_should_broadcast_now(): void
    {
        $ticket = Ticket::factory()->create();
        $event = new TicketCreatedBroadcast($ticket);

        $this->assertInstanceOf(ShouldBroadcastNow::class, $event);
    }
}
