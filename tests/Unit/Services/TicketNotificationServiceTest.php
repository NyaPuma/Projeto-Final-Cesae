<?php

namespace Tests\Unit\Services;

use App\Enums\NotificationTypeEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\UserRoleEnum;
use App\Models\Notification;
use App\Models\Ticket;
use App\Services\TicketNotificationService;
use App\Services\TicketStatusService;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\CreatesTickets;

class TicketNotificationServiceTest extends FeatureTestCase
{
    use CreatesTickets;

    private TicketNotificationService $service;

    protected function setUp(): void
    {
        parent::setUp();

        app(TicketStatusService::class)->flush();

        $this->service = app(TicketNotificationService::class);
    }

    #[Test]
    public function it_notifies_the_ticket_creator_when_the_ticket_is_closed(): void
    {
        $ticket = $this->createTicket();

        $this->service->notifyTicketClosed($ticket, 'O ticket foi encerrado com sucesso.');

        $this->assertDatabaseHas('notifications', [
            'user_id' => $ticket->user_id,
            'type' => NotificationTypeEnum::TicketClosed->value,
            'message' => 'O ticket foi encerrado com sucesso.',
            'link' => "/ui/tickets/{$ticket->id}",
        ]);
    }

    #[Test]
    public function it_skips_notification_when_ticket_has_no_creator(): void
    {
        $ticket = new Ticket(['user_id' => null, 'id' => 1]);

        $this->service->notifyTicketClosed($ticket, 'Sem destinatário.');

        $this->assertEquals(
            0,
            Notification::where('type', NotificationTypeEnum::TicketClosed->value)->count()
        );
    }

    #[Test]
    public function it_notifies_all_admins_when_a_priority_override_occurs(): void
    {
        $adminOne = $this->createAdmin();
        $adminTwo = $this->createAdmin();
        $this->createUserWithToken(UserRoleEnum::Technician->value);

        $ticket = $this->createTicket([
            'title' => 'Ticket de baixa prioridade',
            'priority' => TicketPriorityEnum::Low->value,
        ]);

        $this->service->notifyPriorityOverride($ticket, 'José Técnico', 3);

        $this->assertDatabaseHas('notifications', [
            'user_id' => $adminOne->id,
            'type' => NotificationTypeEnum::PriorityOverride->value,
        ]);
        $this->assertDatabaseHas('notifications', [
            'user_id' => $adminTwo->id,
            'type' => NotificationTypeEnum::PriorityOverride->value,
        ]);
        $this->assertEquals(
            2,
            Notification::where('type', NotificationTypeEnum::PriorityOverride->value)->count()
        );
    }

    #[Test]
    public function it_builds_the_priority_override_message_with_the_urgent_count(): void
    {
        $this->createAdmin();

        $ticket = $this->createTicket([
            'title' => 'Equipamento avariado',
            'priority' => TicketPriorityEnum::Medium->value,
        ]);

        $this->service->notifyPriorityOverride($ticket, 'Ana Técnica', 2);

        $notification = Notification::where('type', NotificationTypeEnum::PriorityOverride->value)->first();

        $this->assertNotNull($notification);
        $this->assertStringContainsString('Ana Técnica', $notification->message);
        $this->assertStringContainsString('2 more urgent pending ticket(s)', $notification->message);
    }
}
