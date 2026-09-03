<?php

namespace Tests\Feature\Domain;

use App\Domain\Ticket\Actions\CancelTicketAction;
use App\Domain\Ticket\Actions\CloseTicketAction;
use App\Domain\Ticket\Actions\ReopenTicketAction;
use App\Domain\Ticket\Actions\StartTicketAction;
use App\Enums\TicketStatusEnum;
use App\Models\User;
use App\Services\TicketStatusService;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\DatabaseTestCase;
use Tests\Concerns\CreatesTickets;

class TicketLifecycleActionsTest extends DatabaseTestCase
{
    use CreatesTickets;

    private TicketStatusService $statusService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->statusService = app(TicketStatusService::class);
    }

    #[Test]
    public function cancel_action_sets_ticket_to_cancelled_and_closes_it(): void
    {
        $ticket = $this->createTicket();
        $action = app(CancelTicketAction::class);

        $result = $action->execute($ticket);

        $this->assertTrue($result);
        $this->assertTrue($ticket->fresh()->hasStatus(TicketStatusEnum::Cancelled));
        $this->assertNotNull($ticket->fresh()->closed_at);
    }

    #[Test]
    public function cancel_action_is_idempotent_when_already_cancelled(): void
    {
        $ticket = $this->createTicketWithStatus(TicketStatusEnum::Cancelled->value);
        $closedAt = $ticket->closed_at;
        $action = app(CancelTicketAction::class);

        $result = $action->execute($ticket);

        $this->assertTrue($result);
        $this->assertEquals($closedAt, $ticket->fresh()->closed_at);
    }

    #[Test]
    public function close_action_sets_cost_report_and_minutes_spent(): void
    {
        $ticket = $this->createTicket();
        $action = app(CloseTicketAction::class);

        $result = $action->execute($ticket, cost: 125.50, report: 'Fonte substituída', minutesSpent: 90);

        $this->assertTrue($result);
        $fresh = $ticket->fresh();
        $this->assertTrue($fresh->hasStatus(TicketStatusEnum::Closed));
        $this->assertEquals(125.50, (float) $fresh->actual_cost);
        $this->assertEquals('Fonte substituída', $fresh->technical_report);
        $this->assertEquals(90, $fresh->minutes_spent);
        $this->assertNotNull($fresh->closed_at);
    }

    #[Test]
    public function close_action_preserves_existing_closed_at(): void
    {
        $ticket = $this->createTicket(['closed_at' => now()->subDays(1)]);
        $closedAt = $ticket->closed_at;
        $action = app(CloseTicketAction::class);

        $action->execute($ticket, cost: 10);

        $this->assertEquals($closedAt->toDateTimeString(), $ticket->fresh()->closed_at->toDateTimeString());
    }

    #[Test]
    public function close_action_is_idempotent_when_already_closed(): void
    {
        $ticket = $this->createTicketWithStatus(TicketStatusEnum::Closed->value);
        $action = app(CloseTicketAction::class);

        $result = $action->execute($ticket, cost: 999);

        $this->assertTrue($result);
        $this->assertNull($ticket->fresh()->actual_cost);
    }

    #[Test]
    public function reopen_action_requires_closed_ticket(): void
    {
        $ticket = $this->createTicket();
        $action = app(ReopenTicketAction::class);

        $this->assertFalse($action->execute($ticket));
        $this->assertTrue($ticket->fresh()->hasStatus(TicketStatusEnum::Open));
        $this->assertNull($ticket->fresh()->closed_at);
    }

    #[Test]
    public function reopen_action_returns_ticket_to_open_state(): void
    {
        $ticket = $this->createTicketWithStatus(TicketStatusEnum::Closed->value);
        $action = app(ReopenTicketAction::class);

        $result = $action->execute($ticket);

        $this->assertTrue($result);
        $fresh = $ticket->fresh();
        $this->assertTrue($fresh->hasStatus(TicketStatusEnum::Open));
        $this->assertNull($fresh->closed_at);
        $this->assertNotNull($fresh->reopened_at);
    }

    #[Test]
    public function start_action_moves_ticket_to_in_progress_and_assigns_user(): void
    {
        $user = User::factory()->create();
        $ticket = $this->createTicket();
        $action = app(StartTicketAction::class);

        $result = $action->execute($ticket, $user);

        $this->assertTrue($result);
        $fresh = $ticket->fresh();
        $this->assertTrue($fresh->hasStatus(TicketStatusEnum::InProgress));
        $this->assertEquals($user->id, $fresh->assigned_to);
        $this->assertNotNull($fresh->in_progress_at);
    }

    #[Test]
    public function start_action_is_idempotent_when_already_in_progress(): void
    {
        $ticket = $this->createTicketWithStatus(TicketStatusEnum::InProgress->value);
        $inProgressAt = $ticket->in_progress_at;
        $action = app(StartTicketAction::class);

        $result = $action->execute($ticket);

        $this->assertTrue($result);
        $this->assertEquals($inProgressAt, $ticket->fresh()->in_progress_at);
    }

    #[Test]
    public function start_action_keeps_existing_assignment_and_start_time(): void
    {
        $assigned = User::factory()->create();
        $ticket = $this->createTicket([
            'assigned_to' => $assigned->id,
            'in_progress_at' => now()->subDay(),
        ]);
        $action = app(StartTicketAction::class);

        $action->execute($ticket);

        $fresh = $ticket->fresh();
        $this->assertEquals($assigned->id, $fresh->assigned_to);
        $this->assertNotNull($fresh->in_progress_at);
    }
}
