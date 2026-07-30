<?php

namespace Tests\Unit\Actions;


use App\Enums\UserRoleEnum;
use App\Actions\ApproveBudgetAction;
use App\DTOs\BudgetDecisionData;
use App\Enums\BudgetDecisionEnum;
use App\Enums\BudgetStatusEnum;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\NotificationService;
use App\Services\TicketStatusService;
use PHPUnit\Framework\Attributes\Test;
use Symfony\Component\HttpKernel\Exception\HttpException;
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
        UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::Technician->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);
    }

    private function seedTicketStatuses(): void
    {
        // Seed ticket statuses manually
        TicketStatus::firstOrCreate(['name' => 'aberta'], ['code' => 'ABERTA', 'description' => 'Aberta']);
        TicketStatus::firstOrCreate(['name' => 'em curso'], ['code' => 'EM_CURSO', 'description' => 'Em Curso']);
        TicketStatus::firstOrCreate(['name' => 'fechada'], ['code' => 'FECHADA', 'description' => 'Fechada']);
        TicketStatus::firstOrCreate(['name' => 'cancelada'], ['code' => 'CANCELADA', 'description' => 'Cancelada']);
        TicketStatus::firstOrCreate(['name' => 'pendente orçamento'], ['code' => 'PENDENTE_ORCAMENTO', 'description' => 'Pendente Orçamento']);
        TicketStatus::firstOrCreate(['name' => 'recusada'], ['code' => 'RECUSADA', 'description' => 'Recusada']);
    }

    #[Test]
    public function it_approves_budget_successfully(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', UserRoleEnum::Admin->value)->first()->id]);
        $statusId = TicketStatus::where('name', 'pendente orçamento')->first()->id;
        $ticket = Ticket::factory()->create([
            'budget_requested' => true,
            'budget_status' => BudgetStatusEnum::Pending->value,
            'budget_amount' => 500.00,
            'status_id' => $statusId,
        ]);

        $data = new BudgetDecisionData(decision: BudgetDecisionEnum::Approve);

        $result = $this->action->execute($ticket, $admin, $data);

        $this->assertEquals(BudgetStatusEnum::Approved->value, $result->budget_status);
        $this->assertEquals($admin->id, $result->budget_approved_by);
        $this->assertNotNull($result->budget_decided_at);
    }

    #[Test]
    public function it_rejects_budget_with_feedback(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', UserRoleEnum::Admin->value)->first()->id]);
        $statusId = TicketStatus::where('name', 'pendente orçamento')->first()->id;
        $ticket = Ticket::factory()->create([
            'budget_requested' => true,
            'budget_status' => BudgetStatusEnum::Pending->value,
            'budget_amount' => 1000.00,
            'status_id' => $statusId,
        ]);

        $data = new BudgetDecisionData(decision: BudgetDecisionEnum::Reject, feedback: 'Orçamento demasiado alto');

        $result = $this->action->execute($ticket, $admin, $data);

        $this->assertEquals(BudgetStatusEnum::Rejected->value, $result->budget_status);
        $this->assertEquals('Orçamento demasiado alto', $result->budget_feedback);
        $this->assertEquals($admin->id, $result->budget_approved_by);
    }

    #[Test]
    public function it_fails_when_budget_not_requested(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', UserRoleEnum::Admin->value)->first()->id]);
        $statusId = TicketStatus::where('name', 'aberta')->first()->id;
        $ticket = Ticket::factory()->create([
            'budget_requested' => false,
            'budget_status' => BudgetStatusEnum::Pending->value,
            'status_id' => $statusId,
        ]);

        $data = new BudgetDecisionData(decision: BudgetDecisionEnum::Approve);

        try {
            $this->action->execute($ticket, $admin, $data);
            $this->fail('Expected HttpException was not thrown');
        } catch (HttpException $e) {
            $this->assertEquals(422, $e->getStatusCode());
        }
    }

    #[Test]
    public function it_fails_when_budget_status_not_pending(): void
    {
        $admin = User::factory()->create(['profile_id' => UserProfile::where('name', UserRoleEnum::Admin->value)->first()->id]);
        $statusId = TicketStatus::where('name', 'aberta')->first()->id;
        $ticket = Ticket::factory()->create([
            'budget_requested' => true,
            'budget_status' => BudgetStatusEnum::Approved->value,
            'status_id' => $statusId,
        ]);

        $data = new BudgetDecisionData(decision: BudgetDecisionEnum::Approve);

        try {
            $this->action->execute($ticket, $admin, $data);
            $this->fail('Expected HttpException was not thrown');
        } catch (HttpException $e) {
            $this->assertEquals(422, $e->getStatusCode());
        }
    }
}
