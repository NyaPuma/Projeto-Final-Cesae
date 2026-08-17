<?php

namespace Tests\Unit\Events;

use App\Enums\TicketStatusEnum;
use App\Events\TicketStatusChanged;
use App\Models\Ticket;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\DatabaseTestCase;

class TicketStatusChangedTest extends DatabaseTestCase
{
    #[Test]
    public function it_broadcasts_on_tickets_and_admin_channels(): void
    {
        $ticket = Ticket::factory()->create();
        $event = new TicketStatusChanged($ticket, 'aberta', 'em curso');

        $channels = $event->broadcastOn();

        $this->assertGreaterThanOrEqual(1, count($channels));
        $this->assertInstanceOf(Channel::class, $channels[0]);
    }

    #[Test]
    public function it_broadcasts_with_correct_event_name(): void
    {
        $ticket = Ticket::factory()->create();
        $event = new TicketStatusChanged($ticket, 'aberta', 'em curso');

        $this->assertEquals('ticket.status_changed', $event->broadcastAs());
    }

    #[Test]
    public function it_normalizes_statuses_and_broadcasts_reference(): void
    {
        $ticket = Ticket::factory()->create([
            'title' => 'Status Test',
            'priority' => 'alta',
        ]);

        $event = new TicketStatusChanged($ticket, 'Aberto', 'Em Curso');
        $data = $event->broadcastWith();

        $this->assertEquals(TicketStatusEnum::Open, $event->oldStatus);
        $this->assertEquals(TicketStatusEnum::InProgress, $event->newStatus);
        $this->assertEquals($ticket->id, $data['ticket_id']);
        $this->assertEquals($ticket->reference, $data['code']);
        $this->assertEquals('aberta', $data['old_status']['value']);
        $this->assertEquals('em curso', $data['new_status']['value']);
        $this->assertFalse($data['is_final']);
    }

    #[Test]
    public function it_implements_should_broadcast(): void
    {
        $ticket = Ticket::factory()->create();
        $event = new TicketStatusChanged($ticket, 'aberta', 'em curso');

        $this->assertInstanceOf(ShouldBroadcast::class, $event);
    }
}
