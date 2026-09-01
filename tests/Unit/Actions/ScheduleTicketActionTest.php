<?php

namespace Tests\Unit\Actions;

use App\Actions\ScheduleTicketAction;
use App\DTOs\ScheduleTicketData;
use App\Enums\TicketStatusEnum;
use App\Services\TicketStatusService;
use Carbon\CarbonImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\CreatesTickets;

class ScheduleTicketActionTest extends FeatureTestCase
{
    use CreatesTickets;

    private ScheduleTicketAction $action;

    protected function setUp(): void
    {
        parent::setUp();

        app(TicketStatusService::class)->flush();

        $this->action = app(ScheduleTicketAction::class);
    }

    #[Test]
    public function it_schedules_an_open_ticket(): void
    {
        $ticket = $this->createTicket();
        $scheduledAt = CarbonImmutable::now()->addDays(3)->startOfHour();

        $result = $this->action->execute(
            $ticket,
            new ScheduleTicketData(scheduledAt: $scheduledAt)
        );

        $this->assertTrue($result->scheduled);
        $this->assertTrue($result->scheduled_at->equalTo($scheduledAt));
        $this->assertNull($result->scheduled_end);
    }

    #[Test]
    public function it_schedules_a_ticket_with_an_end_date(): void
    {
        $ticket = $this->createTicket();
        $scheduledAt = CarbonImmutable::now()->addDays(2)->startOfHour();
        $scheduledEnd = $scheduledAt->addHours(4);

        $result = $this->action->execute(
            $ticket,
            new ScheduleTicketData(scheduledAt: $scheduledAt, scheduledEnd: $scheduledEnd)
        );

        $this->assertTrue($result->scheduled);
        $this->assertTrue($result->scheduled_end->equalTo($scheduledEnd));
    }

    #[Test]
    public function it_rejects_scheduling_a_closed_ticket(): void
    {
        $ticket = $this->createTicketWithStatus(TicketStatusEnum::Closed->value);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Cannot schedule a ticket that is already closed.');

        $this->action->execute(
            $ticket,
            new ScheduleTicketData(scheduledAt: CarbonImmutable::now()->addDays(1))
        );
    }

    #[Test]
    public function it_rejects_a_schedule_whose_end_precedes_the_start(): void
    {
        $scheduledAt = CarbonImmutable::now()->addDays(1);
        $scheduledEnd = $scheduledAt->subHour();

        $this->expectException(InvalidArgumentException::class);

        new ScheduleTicketData(scheduledAt: $scheduledAt, scheduledEnd: $scheduledEnd);
    }

    #[Test]
    public function it_loads_technician_and_status_on_the_scheduled_ticket(): void
    {
        $ticket = $this->createTicket();

        $result = $this->action->execute(
            $ticket,
            new ScheduleTicketData(scheduledAt: CarbonImmutable::now()->addDays(1))
        );

        $this->assertTrue($result->relationLoaded('technician'));
        $this->assertTrue($result->relationLoaded('status'));
    }
}
