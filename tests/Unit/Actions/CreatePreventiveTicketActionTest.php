<?php

namespace Tests\Unit\Actions;

use App\Actions\CreatePreventiveTicketAction;
use App\Enums\TicketPriorityEnum;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\TicketStatusService;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\DatabaseTestCase;

class CreatePreventiveTicketActionTest extends DatabaseTestCase
{
    private CreatePreventiveTicketAction $action;

    private TicketStatusService $statusService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->statusService = app(TicketStatusService::class);
        $this->action = new CreatePreventiveTicketAction($this->statusService);

        $this->seedUserProfiles();
        $this->seedTicketStatuses();
    }

    private function seedUserProfiles(): void
    {
        UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
    }

    private function seedTicketStatuses(): void
    {
        // Seed ticket statuses manually
        TicketStatus::firstOrCreate(['name' => 'aberta'], ['description' => 'Aberta']);
        TicketStatus::firstOrCreate(['name' => 'em curso'], ['description' => 'Em Curso']);
        TicketStatus::firstOrCreate(['name' => 'fechada'], ['description' => 'Fechada']);
        TicketStatus::firstOrCreate(['name' => 'cancelada'], ['description' => 'Cancelada']);
        TicketStatus::firstOrCreate(['name' => 'pendente orçamento'], ['description' => 'Pendente Orçamento']);
        TicketStatus::firstOrCreate(['name' => 'recusada'], ['description' => 'Recusada']);
    }

    #[Test]
    public function it_creates_preventive_ticket_successfully(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id]);
        $technician = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_TECHNICIAN)->first()->id]);

        $result = $this->action->execute(
            $admin,
            'Preventive Maintenance',
            'Scheduled maintenance check',
            $technician->id,
            now()->addDays(7)->toDateTimeString()
        );

        $this->assertInstanceOf(Ticket::class, $result);
        $this->assertEquals('Preventive Maintenance', $result->title);
        $this->assertEquals('Scheduled maintenance check', $result->description);
        $this->assertEquals(TicketPriorityEnum::Medium->value, $result->priority);
        $this->assertEquals($admin->id, $result->user_id);
        $this->assertEquals($technician->id, $result->assigned_to);
        $this->assertTrue($result->scheduled);
        $this->assertNotNull($result->scheduled_at);
    }

    #[Test]
    public function it_creates_preventive_ticket_without_technician(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id]);

        $result = $this->action->execute(
            $admin,
            'Preventive Maintenance',
            null,
            null,
            now()->addDays(7)->toDateTimeString()
        );

        $this->assertInstanceOf(Ticket::class, $result);
        $this->assertNull($result->assigned_to);
        $this->assertEquals('Manutenção preventiva agendada.', $result->description);
    }

    #[Test]
    public function it_ignores_non_technician_assignment(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id]);
        $regularUser = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_USER)->first()->id]);

        $result = $this->action->execute(
            $admin,
            'Preventive Maintenance',
            'Test',
            $regularUser->id,
            now()->addDays(7)->toDateTimeString()
        );

        $this->assertNull($result->assigned_to);
    }

    #[Test]
    public function it_sets_default_description_when_null(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id]);

        $result = $this->action->execute(
            $admin,
            'Preventive Maintenance',
            null,
            null,
            now()->addDays(7)->toDateTimeString()
        );

        $this->assertEquals('Manutenção preventiva agendada.', $result->description);
    }

    #[Test]
    public function it_sets_medium_priority_by_default(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id]);

        $result = $this->action->execute(
            $admin,
            'Preventive Maintenance',
            'Test',
            null,
            now()->addDays(7)->toDateTimeString()
        );

        $this->assertEquals(TicketPriorityEnum::Medium->value, $result->priority);
    }
}
