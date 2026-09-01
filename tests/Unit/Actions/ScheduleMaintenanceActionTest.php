<?php

declare(strict_types=1);

namespace Tests\Unit\Actions;

use App\Actions\ScheduleMaintenanceAction;
use App\DTOs\ScheduleMaintenanceData;
use App\Models\Equipment;
use App\Models\Ticket;
use App\Models\User;
use App\Services\TicketStatusService;
use Tests\Base\DatabaseTestCase;
use Tests\Concerns\CreatesUsers;

final class ScheduleMaintenanceActionTest extends DatabaseTestCase
{
    use CreatesUsers;

    private ScheduleMaintenanceAction $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new ScheduleMaintenanceAction(app(TicketStatusService::class));
    }

    public function test_it_creates_scheduled_preventive_ticket(): void
    {
        // Arrange
        $user = $this->createAdmin();
        $tech = $this->createTechnician();
        $equipment = Equipment::factory()->create();

        $dto = new ScheduleMaintenanceData(
            title: 'Revisão Trimestral AC',
            description: 'Substituição de filtros e verificação de gás',
            scheduledAt: now()->addDays(5)->toDateTimeString(),
            equipmentId: $equipment->id,
            assignedTo: $tech->id,
        );

        // Act
        $ticket = $this->action->execute($user, $dto);

        // Assert
        $this->assertInstanceOf(Ticket::class, $ticket);
        $this->assertSame('Revisão Trimestral AC', $ticket->title);
        $this->assertTrue($ticket->scheduled);
        $this->assertSame($tech->id, $ticket->assigned_to);
        $this->assertSame($equipment->id, $ticket->equipment_id);
        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
            'title' => 'Revisão Trimestral AC',
            'scheduled' => true,
        ]);
    }
}
