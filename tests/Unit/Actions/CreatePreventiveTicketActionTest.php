<?php

namespace Tests\Unit\Actions;

use App\Actions\CreatePreventiveTicketAction;
use App\Enums\TicketPriorityEnum;
use App\Enums\UserRoleEnum;
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
        UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::Technician->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);
    }

    private function seedTicketStatuses(): void
    {
        // Seed ticket statuses manually
        TicketStatus::firstOrCreate(['name' => 'aberta'], ['code' => 'ABERTA', 'description' => 'Aberta']);
        TicketStatus::firstOrCreate(['name' => 'em curso'], ['description' => 'Em Curso']);
        TicketStatus::firstOrCreate(['name' => 'fechada'], ['code' => 'FECHADA', 'description' => 'Fechada']);
        TicketStatus::firstOrCreate(['name' => 'cancelada'], ['code' => 'CANCELADA', 'description' => 'Cancelada']);
        TicketStatus::firstOrCreate(['name' => 'pendente orçamento'], ['description' => 'Pendente Orçamento']);
        TicketStatus::firstOrCreate(['name' => 'recusada'], ['code' => 'RECUSADA', 'description' => 'Recusada']);
    }

    #[Test]
    public function it_creates_preventive_ticket_successfully(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', UserRoleEnum::Admin->value)->first()->id]);
        $technician = User::factory()->create(['profile_id' => UserProfile::where('name', UserRoleEnum::Technician->value)->first()->id]);

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
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', UserRoleEnum::Admin->value)->first()->id]);

        $result = $this->action->execute(
            $admin,
            'Preventive Maintenance',
            null,
            null,
            now()->addDays(7)->toDateTimeString()
        );

        $this->assertInstanceOf(Ticket::class, $result);
        $this->assertNull($result->assigned_to);
        $this->assertEquals('Scheduled preventive maintenance.', $result->description);
    }

    #[Test]
    public function it_ignores_non_technician_assignment(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', UserRoleEnum::Admin->value)->first()->id]);
        $regularUser = User::factory()->create(['profile_id' => UserProfile::where('name', UserRoleEnum::User->value)->first()->id]);

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
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', UserRoleEnum::Admin->value)->first()->id]);

        $result = $this->action->execute(
            $admin,
            'Preventive Maintenance',
            null,
            null,
            now()->addDays(7)->toDateTimeString()
        );

        $this->assertEquals('Scheduled preventive maintenance.', $result->description);
    }

    #[Test]
    public function it_sets_medium_priority_by_default(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', UserRoleEnum::Admin->value)->first()->id]);

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
