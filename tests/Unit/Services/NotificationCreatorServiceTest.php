<?php

namespace Tests\Unit\Services;

use App\Enums\UserRoleEnum;
use App\Models\Notification;
use App\Models\User;
use App\Services\NotificationCreatorService;
use Illuminate\Support\Facades\Log;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;

class NotificationCreatorServiceTest extends FeatureTestCase
{
    private NotificationCreatorService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new NotificationCreatorService();
    }

    #[Test]
    public function it_creates_a_notification_for_a_specific_user(): void
    {
        $user = $this->createRegularUser();

        $this->service->createForUser(
            userId: $user->id,
            title: 'Ticket Fechado',
            message: 'O seu ticket foi encerrado.',
            type: 'ticket_closed',
            link: '/ui/tickets/1',
        );

        $this->assertDatabaseHas('notifications', [
            'user_id' => $user->id,
            'title' => 'Ticket Fechado',
            'message' => 'O seu ticket foi encerrado.',
            'type' => 'ticket_closed',
            'link' => '/ui/tickets/1',
        ]);
    }

    #[Test]
    public function it_creates_notifications_for_all_admins(): void
    {
        $adminOne = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $adminTwo = $this->createUserWithToken(UserRoleEnum::Admin->value);
        $this->createUserWithToken(UserRoleEnum::Technician->value);
        $this->createUserWithToken(UserRoleEnum::User->value);

        $this->service->createForAdmins(
            title: 'Novo Ticket',
            message: 'Foi criado um novo ticket.',
            type: 'ticket_created',
            link: '/ui/tickets/5',
        );

        $this->assertEquals(2, Notification::count());
        $this->assertDatabaseHas('notifications', ['user_id' => $adminOne->id, 'title' => 'Novo Ticket']);
        $this->assertDatabaseHas('notifications', ['user_id' => $adminTwo->id, 'title' => 'Novo Ticket']);
    }

    #[Test]
    public function it_logs_a_warning_and_does_not_crash_when_notification_fails(): void
    {
        $nonexistentUserId = 999999;

        Log::shouldReceive('warning')
            ->once()
            ->with('Failed to create notification', \Mockery::on(fn ($context) => ($context['user_id'] ?? null) === $nonexistentUserId));

        $this->service->createForUser(
            userId: $nonexistentUserId,
            title: 'Falha forçada',
            message: 'Teste',
            type: 'ticket_closed',
            link: '/ui/tickets/1',
        );

        $this->assertEquals(0, Notification::count());
    }

    #[Test]
    public function it_does_not_create_notifications_when_no_admins_exist(): void
    {
        $this->createUserWithToken(UserRoleEnum::User->value);

        $this->service->createForAdmins(
            title: 'Sem destinatários',
            message: 'Ninguém deve receber.',
            type: 'ticket_created',
            link: '/ui/tickets/1',
        );

        $this->assertEquals(0, Notification::count());
    }
}
