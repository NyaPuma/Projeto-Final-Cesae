<?php

namespace Tests\Feature\Domain;

use App\Domain\Ticket\Actions\CheckHigherPriorityAction;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\User;
use App\Services\TicketStatusService;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\DatabaseTestCase;
use Tests\Concerns\CreatesTickets;

class CheckHigherPriorityActionTest extends DatabaseTestCase
{
    use CreatesTickets;

    private TicketStatusService $statusService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->statusService = app(TicketStatusService::class);
    }

    #[Test]
    public function it_reports_higher_priority_open_tickets(): void
    {
        $target = $this->createTicket(['priority' => TicketPriorityEnum::Low->value]);
        $this->createTicket(['priority' => TicketPriorityEnum::High->value]);
        $this->createTicket(['priority' => TicketPriorityEnum::Critical->value]);

        $result = app(CheckHigherPriorityAction::class)->execute($target);

        $this->assertEquals(2, $result['total']);
        $this->assertTrue($result['has_higher']);
    }

    #[Test]
    public function it_counts_higher_priority_tickets_assigned_to_same_user(): void
    {
        $technician = User::factory()->create();
        $target = $this->createTicket([
            'priority' => TicketPriorityEnum::Medium->value,
            'assigned_to' => $technician->id,
        ]);
        $this->createTicket([
            'priority' => TicketPriorityEnum::High->value,
            'assigned_to' => $technician->id,
        ]);
        $this->createTicket([
            'priority' => TicketPriorityEnum::High->value,
            'assigned_to' => User::factory()->create()->id,
        ]);

        $result = app(CheckHigherPriorityAction::class)->execute($target);

        $this->assertEquals(2, $result['total']);
        $this->assertEquals(1, $result['assigned_to_user']);
        $this->assertTrue($result['has_higher']);
    }

    #[Test]
    public function it_ignores_non_open_tickets_and_the_target_itself(): void
    {
        $target = $this->createTicket(['priority' => TicketPriorityEnum::Medium->value]);

        $sameTicketHigher = $this->createTicket(['priority' => TicketPriorityEnum::High->value]);
        $closed = $this->createTicket([
            'priority' => TicketPriorityEnum::Critical->value,
            'status_id' => app(TicketStatusService::class)->getByName(TicketStatusEnum::Closed),
        ]);

        $result = app(CheckHigherPriorityAction::class)->execute($target);

        $this->assertNotEquals($target->id, $sameTicketHigher->id);
        $this->assertNotNull($closed->id);
        $this->assertEquals(1, $result['total']);
    }

    #[Test]
    public function it_returns_zeroes_when_no_higher_priorities_exist(): void
    {
        $target = $this->createTicket(['priority' => TicketPriorityEnum::Critical->value]);

        $result = app(CheckHigherPriorityAction::class)->execute($target);

        $this->assertEquals(0, $result['total']);
        $this->assertEquals(0, $result['assigned_to_user']);
        $this->assertFalse($result['has_higher']);
    }

    #[Test]
    public function it_returns_zeroes_for_unrecognized_priority(): void
    {
        $target = $this->createTicket(['priority' => TicketPriorityEnum::Low->value]);
        $target->priority = 'desconhecida';

        $result = app(CheckHigherPriorityAction::class)->execute($target);

        $this->assertEquals(0, $result['total']);
        $this->assertFalse($result['has_higher']);
    }
}
