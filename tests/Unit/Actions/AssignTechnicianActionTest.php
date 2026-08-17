<?php

namespace Tests\Unit\Actions;

use App\Actions\AssignTechnicianAction;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TicketStatusService;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\CreatesTickets;
use Tests\Concerns\CreatesUsers;

class AssignTechnicianActionTest extends FeatureTestCase
{
    use CreatesTickets;
    use CreatesUsers;

    private AssignTechnicianAction $action;

    protected function setUp(): void
    {
        parent::setUp();

        app(TicketStatusService::class)->flush();

        $this->action = app(AssignTechnicianAction::class);
    }

    #[Test]
    public function it_assigns_a_technician_when_passed_a_user_instance(): void
    {
        $technician = $this->createTechnician();
        $ticket = $this->createTicket();

        $result = $this->action->execute($ticket, $technician);

        $this->assertEquals($technician->id, $result->assigned_to);
        $this->assertEquals($technician->id, $result->technician->id);
    }

    #[Test]
    public function it_assigns_a_technician_when_passed_a_technician_id(): void
    {
        $technician = $this->createTechnician();
        $ticket = $this->createTicket();

        $result = $this->action->execute($ticket, $technician->id);

        $this->assertEquals($technician->id, $result->assigned_to);
    }

    #[Test]
    public function it_auto_assigns_the_least_busy_technician_when_null_is_passed(): void
    {
        $busyTechnician = $this->createTechnician();
        $freeTechnician = $this->createTechnician();

        $busyTicket = $this->createTicketWithStatus('em curso');
        $busyTicket->assigned_to = $busyTechnician->id;
        $busyTicket->save();

        $ticket = $this->createTicket();

        $result = $this->action->execute($ticket, null);

        $this->assertEquals($freeTechnician->id, $result->assigned_to);
    }

    #[Test]
    public function it_does_not_assign_a_non_technician_user(): void
    {
        $user = $this->createRegularUser();
        $ticket = $this->createTicket();

        $result = $this->action->execute($ticket, $user);

        $this->assertNull($result->assigned_to);
    }

    #[Test]
    public function it_does_not_assign_when_the_technician_does_not_exist(): void
    {
        $ticket = $this->createTicket();

        $result = $this->action->execute($ticket, 99999);

        $this->assertNull($result->assigned_to);
    }

    #[Test]
    public function it_leaves_the_ticket_unassigned_when_no_technician_is_available(): void
    {
        $ticket = $this->createTicket();

        $result = $this->action->execute($ticket, null);

        $this->assertNull($result->assigned_to);
        $this->assertInstanceOf(Ticket::class, $result);
    }

    #[Test]
    public function it_loads_the_technician_relation_on_the_returned_ticket(): void
    {
        $technician = $this->createTechnician();
        $ticket = $this->createTicket();

        $result = $this->action->execute($ticket, $technician);

        $this->assertTrue($result->relationLoaded('technician'));
        $this->assertInstanceOf(User::class, $result->technician);
    }
}
