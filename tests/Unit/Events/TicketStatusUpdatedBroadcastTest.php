<?php

namespace Tests\Unit\Events;

use App\Events\TicketStatusUpdatedBroadcast;
use App\Models\Ticket;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\DatabaseTestCase;

class TicketStatusUpdatedBroadcastTest extends DatabaseTestCase
{
    #[Test]
    public function it_broadcasts_on_tickets_channel(): void
    {
        $ticket = Ticket::factory()->create();
        $event = new TicketStatusUpdatedBroadcast($ticket, 'aberta', 'em curso');

        $channels = $event->broadcastOn();

        $this->assertGreaterThanOrEqual(1, count($channels));
        $this->assertInstanceOf(Channel::class, $channels[0]);
    }

    #[Test]
    public function it_broadcasts_with_correct_event_name(): void
    {
        $ticket = Ticket::factory()->create();
        $event = new TicketStatusUpdatedBroadcast($ticket, 'aberta', 'em curso');

        $this->assertEquals('ticket.status.updated', $event->broadcastAs());
    }

    #[Test]
    public function it_broadcasts_with_ticket_data(): void
    {
        $ticket = Ticket::factory()->create([
            'title' => 'Status Update Test',
            'priority' => 'média',
        ]);

        $event = new TicketStatusUpdatedBroadcast($ticket, 'aberta', 'em curso');
        $data = $event->broadcastWith();

        $this->assertEquals($ticket->id, $data['id']);
        $this->assertEquals($ticket->reference, $data['code']);
        $this->assertEquals('Status Update Test', $data['title']);
        $this->assertEquals('aberta', $data['old_status']['value']);
        $this->assertEquals('em curso', $data['new_status']['value']);
    }

    #[Test]
    public function it_implements_should_broadcast_now(): void
    {
        $ticket = Ticket::factory()->create();
        $event = new TicketStatusUpdatedBroadcast($ticket, 'aberta', 'em curso');

        $this->assertInstanceOf(ShouldBroadcastNow::class, $event);
    }
}
