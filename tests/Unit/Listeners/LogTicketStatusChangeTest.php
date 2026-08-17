<?php

namespace Tests\Unit\Listeners;

use App\Enums\TicketStatusEnum;
use App\Events\TicketStatusUpdatedBroadcast;
use App\Listeners\LogTicketStatusChange;
use App\Models\Ticket;
use App\Models\TicketStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LogTicketStatusChangeTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_logs_the_transition_to_workflow_history(): void
    {
        $open = TicketStatus::firstOrCreate(['name' => 'aberta'], ['code' => 'ABERTA']);
        $inProgress = TicketStatus::firstOrCreate(['name' => 'em curso'], ['code' => 'EM_CURSO']);
        $ticket = Ticket::factory()->create(['status_id' => $open->id]);

        $listener = new LogTicketStatusChange();
        $listener->handle(new TicketStatusUpdatedBroadcast(
            $ticket,
            TicketStatusEnum::Open,
            TicketStatusEnum::InProgress,
        ));

        $this->assertDatabaseHas('ticket_workflow_history', [
            'ticket_id' => $ticket->id,
            'origin_status_id' => $open->id,
            'destination_status_id' => $inProgress->id,
            'technician_id' => $ticket->assigned_to,
        ]);
    }

    #[Test]
    public function it_warns_when_statuses_cannot_be_resolved(): void
    {
        $ticket = Ticket::factory()->create();

        Log::spy();

        $listener = new LogTicketStatusChange();
        $listener->handle(new TicketStatusUpdatedBroadcast(
            $ticket,
            TicketStatusEnum::Open,
            TicketStatusEnum::InProgress,
        ));

        Log::shouldHaveReceived('warning')
            ->once()
            ->withArgs(fn (string $message): bool => str_contains($message, 'Could not resolve status IDs'));

        $this->assertDatabaseCount('ticket_workflow_history', 0);
    }
}
