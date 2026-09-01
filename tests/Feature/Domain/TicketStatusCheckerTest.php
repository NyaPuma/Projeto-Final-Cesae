<?php

namespace Tests\Feature\Domain;

use App\Domain\Ticket\Services\TicketStatusChecker;
use App\Enums\TicketStatusEnum;
use App\Services\TicketStatusService;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\DatabaseTestCase;
use Tests\Concerns\CreatesTickets;

class TicketStatusCheckerTest extends DatabaseTestCase
{
    use CreatesTickets;

    private TicketStatusService $statusService;

    private TicketStatusChecker $checker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->statusService = app(TicketStatusService::class);
        $this->checker = new TicketStatusChecker($this->statusService);
    }

    #[Test]
    public function it_verifies_status_of_a_ticket_instance(): void
    {
        $ticket = $this->createTicket();

        $this->assertTrue($this->checker->hasStatus($ticket, TicketStatusEnum::Open));
        $this->assertFalse($this->checker->hasStatus($ticket, TicketStatusEnum::Closed));
    }

    #[Test]
    public function it_verifies_status_by_raw_status_id(): void
    {
        $openId = $this->statusService->getByName(TicketStatusEnum::Open);

        $this->assertTrue($this->checker->hasStatus($openId, TicketStatusEnum::Open));
        $this->assertFalse($this->checker->hasStatus($openId, TicketStatusEnum::InProgress));
    }

    #[Test]
    public function it_returns_false_for_null_or_invalid_status_ids(): void
    {
        $this->assertFalse($this->checker->hasStatus(null, TicketStatusEnum::Open));
        $this->assertFalse($this->checker->hasStatus(0, TicketStatusEnum::Open));
        $this->assertFalse($this->checker->hasStatus(-5, TicketStatusEnum::Open));
    }

    #[Test]
    public function it_returns_false_for_a_matching_status_id_on_another_ticket(): void
    {
        $closed = $this->createTicketWithStatus('fechada');

        $this->assertFalse($this->checker->hasStatus($closed, TicketStatusEnum::Open));
    }
}
