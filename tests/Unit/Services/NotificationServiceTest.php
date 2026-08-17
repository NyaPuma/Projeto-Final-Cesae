<?php

namespace Tests\Unit\Services;

use App\Enums\NotificationTypeEnum;
use App\Models\Notification;
use App\Models\Ticket;
use App\Services\NotificationService;
use App\Services\TicketStatusService;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\CreatesTickets;

class NotificationServiceTest extends FeatureTestCase
{
    use CreatesTickets;

    private NotificationService $service;

    protected function setUp(): void
    {
        parent::setUp();

        app(TicketStatusService::class)->flush();

        $this->service = app(NotificationService::class);
    }

    #[Test]
    public function it_routes_budget_submitted_to_admins_and_ticket_creator(): void
    {
        $admin = $this->createAdmin();
        $ticket = $this->createTicket();
        $creatorId = $ticket->user_id;

        $this->service->notifyBudgetSubmitted($ticket, 'Orçamento submetido.');

        $this->assertDatabaseHas('notifications', [
            'user_id' => $admin->id,
            'type' => NotificationTypeEnum::BudgetRequest->value,
            'message' => 'Orçamento submetido.',
        ]);
        $this->assertDatabaseHas('notifications', [
            'user_id' => $creatorId,
            'type' => NotificationTypeEnum::BudgetSubmitted->value,
            'message' => 'Orçamento submetido.',
        ]);
    }

    #[Test]
    public function it_routes_budget_auto_approved_to_assigned_technician_and_creator(): void
    {
        $technician = $this->createTechnician();
        $ticket = $this->createTicket(['assigned_to' => $technician->id]);

        $this->service->notifyBudgetAutoApproved($ticket, 'Auto-aprovado.');

        $this->assertEquals(
            1,
            Notification::where('type', NotificationTypeEnum::BudgetAutoApproved->value)
                ->where('user_id', $technician->id)
                ->count()
        );
        $this->assertEquals(
            1,
            Notification::where('type', NotificationTypeEnum::BudgetAutoApproved->value)
                ->where('user_id', $ticket->user_id)
                ->count()
        );
    }

    #[Test]
    public function it_routes_budget_decision_approve_to_approved_notifications(): void
    {
        $ticket = $this->createTicket();

        $this->service->notifyBudgetDecision($ticket, 'approve', 'Aprovado.');

        $this->assertGreaterThan(
            0,
            Notification::where('type', NotificationTypeEnum::BudgetApproved->value)->count()
        );
    }

    #[Test]
    public function it_routes_budget_decision_reject_to_rejected_notifications(): void
    {
        $ticket = $this->createTicket();

        $this->service->notifyBudgetDecision($ticket, 'reject', 'Recusado.');

        $this->assertGreaterThan(
            0,
            Notification::where('type', NotificationTypeEnum::BudgetRejected->value)->count()
        );
    }

    #[Test]
    public function it_routes_ticket_closed_to_the_ticket_creator(): void
    {
        $ticket = $this->createTicket();

        $this->service->notifyTicketClosed($ticket, 'Ticket encerrado.');

        $this->assertDatabaseHas('notifications', [
            'user_id' => $ticket->user_id,
            'type' => NotificationTypeEnum::TicketClosed->value,
            'message' => 'Ticket encerrado.',
        ]);
    }

    #[Test]
    public function it_routes_priority_override_to_administrators(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $ticket = $this->createTicket();

        $this->service->notifyPriorityOverride($ticket, $technician, 2);

        $this->assertDatabaseHas('notifications', [
            'user_id' => $admin->id,
            'type' => NotificationTypeEnum::PriorityOverride->value,
        ]);
    }

    #[Test]
    public function it_routes_ticket_created_to_administrators(): void
    {
        $admin = $this->createAdmin();
        $ticket = $this->createTicket(['title' => 'Ticket novo']);

        $this->service->notifyTicketCreated($ticket);

        $this->assertDatabaseHas('notifications', [
            'user_id' => $admin->id,
            'type' => NotificationTypeEnum::TicketCreated->value,
        ]);
    }

    #[Test]
    public function it_skips_closed_notification_when_ticket_has_no_creator(): void
    {
        $ticket = new Ticket(['user_id' => null, 'id' => 1]);

        $this->service->notifyTicketClosed($ticket, 'Sem criador.');

        $this->assertEquals(
            0,
            Notification::where('type', NotificationTypeEnum::TicketClosed->value)->count()
        );
    }
}
