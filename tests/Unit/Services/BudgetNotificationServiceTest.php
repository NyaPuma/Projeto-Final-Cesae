<?php

namespace Tests\Unit\Services;

use App\Enums\NotificationTypeEnum;
use App\Models\Notification;
use App\Models\Ticket;
use App\Services\BudgetNotificationService;
use App\Services\TicketStatusService;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\CreatesTickets;

class BudgetNotificationServiceTest extends FeatureTestCase
{
    use CreatesTickets;

    private BudgetNotificationService $service;

    protected function setUp(): void
    {
        parent::setUp();

        app(TicketStatusService::class)->flush();

        $this->service = app(BudgetNotificationService::class);
    }

    #[Test]
    public function it_notifies_admins_and_the_creator_when_a_budget_is_submitted(): void
    {
        $admin = $this->createAdmin();
        $ticket = $this->createTicket();

        $this->service->notifyBudgetSubmitted($ticket, 'Orçamento submetido para aprovação.');

        $this->assertDatabaseHas('notifications', [
            'user_id' => $admin->id,
            'type' => NotificationTypeEnum::BudgetRequest->value,
            'message' => 'Orçamento submetido para aprovação.',
        ]);
        $this->assertDatabaseHas('notifications', [
            'user_id' => $ticket->user_id,
            'type' => NotificationTypeEnum::BudgetSubmitted->value,
            'message' => 'Orçamento submetido para aprovação.',
        ]);
    }

    #[Test]
    public function it_notifies_the_assigned_technician_and_creator_on_auto_approval(): void
    {
        $technician = $this->createTechnician();
        $ticket = $this->createTicket(['assigned_to' => $technician->id]);

        $this->service->notifyBudgetAutoApproved($ticket, 'Orçamento auto-aprovado.');

        $this->assertDatabaseHas('notifications', [
            'user_id' => $technician->id,
            'type' => NotificationTypeEnum::BudgetAutoApproved->value,
        ]);
        $this->assertDatabaseHas('notifications', [
            'user_id' => $ticket->user_id,
            'type' => NotificationTypeEnum::BudgetAutoApproved->value,
        ]);
    }

    #[Test]
    public function it_notifies_with_approved_type_when_decision_is_approve(): void
    {
        $ticket = $this->createTicket();

        $this->service->notifyBudgetDecision($ticket, 'approve', 'Orçamento aprovado.');

        $this->assertDatabaseHas('notifications', [
            'user_id' => $ticket->user_id,
            'type' => NotificationTypeEnum::BudgetApproved->value,
        ]);
    }

    #[Test]
    public function it_notifies_with_rejected_type_when_decision_is_reject(): void
    {
        $ticket = $this->createTicket();

        $this->service->notifyBudgetDecision($ticket, 'reject', 'Orçamento recusado.');

        $this->assertDatabaseHas('notifications', [
            'user_id' => $ticket->user_id,
            'type' => NotificationTypeEnum::BudgetRejected->value,
        ]);
    }

    #[Test]
    public function it_notifies_administrators_when_a_ticket_is_created(): void
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
    public function it_skips_creator_notifications_when_ticket_has_no_creator(): void
    {
        $admin = $this->createAdmin();
        $ticket = new Ticket(['user_id' => null, 'id' => 1]);

        $this->service->notifyBudgetSubmitted($ticket, 'Sem criador.');

        $this->assertDatabaseHas('notifications', [
            'user_id' => $admin->id,
            'type' => NotificationTypeEnum::BudgetRequest->value,
        ]);
        $this->assertEquals(
            1,
            Notification::where('type', NotificationTypeEnum::BudgetRequest->value)->count()
        );
    }
}
