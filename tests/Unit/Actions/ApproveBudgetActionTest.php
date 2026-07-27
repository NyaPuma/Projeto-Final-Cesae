<?php

namespace Tests\Unit\Actions;

use App\Actions\ApproveBudgetAction;
use App\DTOs\BudgetDecisionData;
use App\Enums\BudgetStatusEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\NotificationService;
use App\Services\TicketStatusService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\DatabaseTestCase;

class ApproveBudgetActionTest extends DatabaseTestCase
{

    private ApproveBudgetAction $action;

    private NotificationService $notificationService;

    private TicketStatusService $statusService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->notificationService = app(NotificationService::class);
        $this->statusService = app(TicketStatusService::class);

        $this->action = new ApproveBudgetAction(
            $this->notificationService,
            $this->statusService
        );

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
        \App\Models\TicketStatus::firstOrCreate(['name' => 'aberta'], ['description' => 'Aberta']);
        \App\Models\TicketStatus::firstOrCreate(['name' => 'em curso'], ['description' => 'Em Curso']);
        \App\Models\TicketStatus::firstOrCreate(['name' => 'fechada'], ['description' => 'Fechada']);
        \App\Models\TicketStatus::firstOrCreate(['name' => 'cancelada'], ['description' => 'Cancelada']);
        \App\Models\TicketStatus::firstOrCreate(['name' => 'pendente orçamento'], ['description' => 'Pendente Orçamento']);
        \App\Models\TicketStatus::firstOrCreate(['name' => 'recusada'], ['description' => 'Recusada']);
    }

    #[Test]
    public function it_approves_budget_successfully(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id]);
        $statusId = \App\Models\TicketStatus::where('name', 'pendente orçamento')->first()->id;
        $ticket = Ticket::factory()->create([
            'budget_requested' => true,
            'budget_status' => BudgetStatusEnum::Pending->value,
            'budget_amount' => 500.00,
            'status_id' => $statusId,
        ]);

        $data = new BudgetDecisionData(decision: 'approve');

        $result = $this->action->execute($ticket, $admin, $data);

        $this->assertEquals(BudgetStatusEnum::Approved->value, $result->budget_status);
        $this->assertEquals($admin->id, $result->budget_approved_by);
        $this->assertNotNull($result->budget_decided_at);
    }

    #[Test]
    public function it_rejects_budget_with_feedback(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id]);
        $statusId = \App\Models\TicketStatus::where('name', 'pendente orçamento')->first()->id;
        $ticket = Ticket::factory()->create([
            'budget_requested' => true,
            'budget_status' => BudgetStatusEnum::Pending->value,
            'budget_amount' => 1000.00,
            'status_id' => $statusId,
        ]);

        $data = new BudgetDecisionData(decision: 'reject', feedback: 'Orçamento demasiado alto');

        $result = $this->action->execute($ticket, $admin, $data);

        $this->assertEquals(BudgetStatusEnum::Rejected->value, $result->budget_status);
        $this->assertEquals('Orçamento demasiado alto', $result->budget_feedback);
        $this->assertEquals($admin->id, $result->budget_approved_by);
    }

    #[Test]
    public function it_fails_when_budget_not_requested(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id]);
        $statusId = \App\Models\TicketStatus::where('name', 'aberta')->first()->id;
        $ticket = Ticket::factory()->create([
            'budget_requested' => false,
            'budget_status' => BudgetStatusEnum::Pending->value,
            'status_id' => $statusId,
        ]);

        $data = new BudgetDecisionData(decision: 'approve');

        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);
        $this->expectExceptionCode(422);

        $this->action->execute($ticket, $admin, $data);
    }

    #[Test]
    public function it_fails_when_budget_status_not_pending(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', User::ROLE_ADMIN)->first()->id]);
        $statusId = \App\Models\TicketStatus::where('name', 'aberta')->first()->id;
        $ticket = Ticket::factory()->create([
            'budget_requested' => true,
            'budget_status' => BudgetStatusEnum::Approved->value,
            'status_id' => $statusId,
        ]);

        $data = new BudgetDecisionData(decision: 'approve');

        $this->expectException(\Symfony\Component\HttpKernel\Exception\HttpException::class);
        $this->expectExceptionCode(422);

        $this->action->execute($ticket, $admin, $data);
    }
}
