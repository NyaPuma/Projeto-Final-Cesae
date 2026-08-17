<?php

namespace Tests\Unit\Services;

use App\Enums\TicketPriorityEnum;
use App\Enums\UserRoleEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TechnicianAssignmentService;
use App\Services\TicketStatusService;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\CreatesTickets;

class TechnicianAssignmentServiceTest extends FeatureTestCase
{
    use CreatesTickets;

    private TechnicianAssignmentService $service;

    protected function setUp(): void
    {
        parent::setUp();

        app(TicketStatusService::class)->flush();

        $this->service = app(TechnicianAssignmentService::class);
    }

    #[Test]
    public function it_returns_the_least_busy_active_technician(): void
    {
        $busyTechnician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $freeTechnician = $this->createUserWithToken(UserRoleEnum::Technician->value);

        $inProgressId = app(TicketStatusService::class)->getByName(\App\Enums\TicketStatusEnum::InProgress);
        $this->createTicket(['assigned_to' => $busyTechnician->id, 'status_id' => $inProgressId]);
        $this->createTicket(['assigned_to' => $busyTechnician->id, 'status_id' => $inProgressId]);

        $result = $this->service->getLeastBusyTechnician();

        $this->assertNotNull($result);
        $this->assertEquals($freeTechnician->id, $result->id);
    }

    #[Test]
    public function it_excludes_inactive_and_non_technician_users(): void
    {
        $this->createUserWithToken(UserRoleEnum::Technician->value, ['active' => false]);
        $this->createUserWithToken(UserRoleEnum::User->value);
        $this->createUserWithToken(UserRoleEnum::Admin->value);

        $result = $this->service->getLeastBusyTechnician();

        $this->assertNull($result);
    }

    #[Test]
    public function it_assigns_a_specific_technician_to_the_ticket(): void
    {
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createTicket();

        $result = $this->service->assignToTicket($ticket, $technician->id);

        $this->assertNotNull($result);
        $this->assertEquals($technician->id, $result->id);
        $this->assertEquals($technician->id, $ticket->fresh()->assigned_to);
    }

    #[Test]
    public function it_returns_null_and_does_not_assign_for_non_technician_ids(): void
    {
        $regularUser = $this->createUserWithToken(UserRoleEnum::User->value);
        $ticket = $this->createTicket();

        $result = $this->service->assignToTicket($ticket, $regularUser->id);

        $this->assertNull($result);
        $this->assertNull($ticket->fresh()->assigned_to);
    }

    #[Test]
    public function it_returns_null_for_nonexistent_technician_ids(): void
    {
        $ticket = $this->createTicket();

        $result = $this->service->assignToTicket($ticket, 999999);

        $this->assertNull($result);
        $this->assertNull($ticket->fresh()->assigned_to);
    }

    #[Test]
    public function it_auto_assigns_the_least_busy_technician_when_id_is_null(): void
    {
        $technician = $this->createUserWithToken(UserRoleEnum::Technician->value);
        $ticket = $this->createTicket();

        $result = $this->service->assignToTicket($ticket, null);

        $this->assertNotNull($result);
        $this->assertEquals($technician->id, $result->id);
        $this->assertEquals($technician->id, $ticket->fresh()->assigned_to);
    }

    #[Test]
    public function it_returns_null_when_no_technician_exists_for_auto_assignment(): void
    {
        $ticket = $this->createTicket();

        $result = $this->service->assignToTicket($ticket, null);

        $this->assertNull($result);
        $this->assertNull($ticket->fresh()->assigned_to);
    }

    #[Test]
    public function it_finds_the_most_urgent_open_ticket_by_priority(): void
    {
        $this->createTicket(['priority' => TicketPriorityEnum::Low->value]);
        $this->createTicket(['priority' => TicketPriorityEnum::High->value]);
        $this->createTicket(['priority' => TicketPriorityEnum::Medium->value]);

        $result = $this->service->findMostUrgentOpenTicket();

        $this->assertNotNull($result);
        $this->assertEquals(TicketPriorityEnum::High->value, $result->priority);
    }

    #[Test]
    public function it_breaks_priority_ties_by_oldest_creation(): void
    {
        $older = $this->createTicket(['priority' => TicketPriorityEnum::Medium->value, 'created_at' => now()->subHours(3)]);
        $this->createTicket(['priority' => TicketPriorityEnum::Medium->value, 'created_at' => now()->subHours(1)]);

        $result = $this->service->findMostUrgentOpenTicket();

        $this->assertEquals($older->id, $result->id);
    }

    #[Test]
    public function it_can_exclude_a_ticket_from_the_urgent_search(): void
    {
        $excluded = $this->createTicket(['priority' => TicketPriorityEnum::Critical->value]);
        $this->createTicket(['priority' => TicketPriorityEnum::High->value]);

        $result = $this->service->findMostUrgentOpenTicket($excluded->id);

        $this->assertNotEquals($excluded->id, $result->id);
        $this->assertEquals(TicketPriorityEnum::High->value, $result->priority);
    }

    #[Test]
    public function it_ignores_tickets_that_are_not_open(): void
    {
        $closedStatusId = app(TicketStatusService::class)->getByName(\App\Enums\TicketStatusEnum::Closed);
        $this->createTicket([
            'priority' => TicketPriorityEnum::Critical->value,
            'status_id' => $closedStatusId,
        ]);

        $result = $this->service->findMostUrgentOpenTicket();

        $this->assertNull($result);
    }
}
