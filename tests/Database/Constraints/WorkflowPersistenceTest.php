<?php

namespace Tests\Database\Constraints;

use App\Actions\ApproveBudgetAction;
use App\DTOs\BudgetDecisionData;
use App\Enums\BudgetDecisionEnum;
use App\Enums\BudgetStatusEnum;
use App\Enums\TicketStatusEnum;
use App\Enums\UserRoleEnum;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\TicketWorkflowService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkflowPersistenceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seedLookupData();
    }

    protected function seedLookupData(): void
    {
        TicketStatus::firstOrCreate(['name' => 'aberta'], ['code' => 'ABERTA', 'description' => 'Aberta']);
        TicketStatus::firstOrCreate(['name' => 'em curso'], ['code' => 'EM_CURSO', 'description' => 'Em curso']);
        TicketStatus::firstOrCreate(['name' => 'fechada'], ['code' => 'FECHADA', 'description' => 'Fechada']);
        TicketStatus::firstOrCreate(['name' => 'cancelada'], ['code' => 'CANCELADA', 'description' => 'Cancelada']);
        TicketStatus::firstOrCreate(['name' => 'pendente orçamento'], ['code' => 'PENDENTE_ORCAMENTO', 'description' => 'Pendente']);
        TicketStatus::firstOrCreate(['name' => 'recusada'], ['code' => 'RECUSADA', 'description' => 'Recusada']);
    }

    protected function createAdmin(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        $token = 'admin-persist-token-'.uniqid();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => $token,
        ]);
        $user->raw_token = $token;

        return $user;
    }

    protected function createTechnician(): User
    {
        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::Technician->value]);
        $token = 'tech-persist-token-'.uniqid();
        $user = User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => $token,
        ]);
        $user->raw_token = $token;

        return $user;
    }

    protected function asUserWithToken(User $user): static
    {
        return $this->withHeader('X-Auth-Token', $user->api_token)
            ->withHeader('Accept', 'application/json');
    }

    // ==========================================
    // SECTION 8: STATUS WORKFLOW INTEGRITY
    // ==========================================

    public function test_ticket_status_transitions_through_workflow(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'Workflow Test',
            'description' => 'Status transitions',
            'priority' => 'baixa',
        ]);
        $ticketId = $response->json('ticket.id');

        $openStatus = TicketStatus::where('name', 'aberta')->first();
        $inProgressStatus = TicketStatus::where('name', 'em curso')->first();

        $ticket = Ticket::find($ticketId);
        $this->assertEquals($openStatus->id, $ticket->status_id);

        $ticket->update([
            'status_id' => $inProgressStatus->id,
            'assigned_to' => $technician->id,
            'in_progress_at' => now(),
        ]);

        $ticket->refresh();
        $this->assertEquals($inProgressStatus->id, $ticket->status_id);
        $this->assertNotNull($ticket->in_progress_at);
    }

    public function test_ticket_budget_workflow(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'Budget Workflow Test',
            'description' => 'Budget test',
            'priority' => 'alta',
        ]);
        $ticketId = $response->json('ticket.id');

        $pendingStatus = TicketStatus::where('name', 'pendente orçamento')->first();
        $ticket = Ticket::find($ticketId);
        $ticket->update([
            'status_id' => $pendingStatus->id,
            'budget_requested' => true,
            'budget_status' => BudgetStatusEnum::Pending->value,
            'budget_amount' => 100.00,
            'budget_requested_at' => now(),
            'assigned_to' => $technician->id,
        ]);

        $ticket->refresh();
        $this->assertEquals(BudgetStatusEnum::Pending->value, $ticket->budget_status);
        $this->assertTrue($ticket->budget_requested);
        $this->assertNotNull($ticket->budget_requested_at);

        $data = new BudgetDecisionData(decision: BudgetDecisionEnum::Approve);
        app(ApproveBudgetAction::class)->execute($ticket, $admin, $data);
        $ticket->refresh();
        $this->assertEquals(BudgetStatusEnum::Approved->value, $ticket->budget_status);
        $this->assertNotNull($ticket->budget_decided_at);
    }

    public function test_ticket_budget_rejection(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'Budget Reject Test',
            'description' => 'Budget reject',
            'priority' => 'alta',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);
        $ticket->update([
            'budget_requested' => true,
            'budget_status' => BudgetStatusEnum::Pending->value,
            'budget_amount' => 200.00,
            'budget_requested_at' => now(),
            'assigned_to' => $technician->id,
        ]);

        $data = new BudgetDecisionData(decision: BudgetDecisionEnum::Reject, feedback: 'Too expensive');
        app(ApproveBudgetAction::class)->execute($ticket, $admin, $data);
        $ticket->refresh();
        $this->assertEquals(BudgetStatusEnum::Rejected->value, $ticket->budget_status);
        $this->assertEquals('Too expensive', $ticket->budget_feedback);
    }

    // ==========================================
    // SECTION 20: REOPEN WORKFLOW
    // ==========================================

    public function test_ticket_reopen_workflow(): void
    {
        $admin = $this->createAdmin();
        $technician = $this->createTechnician();
        $this->asUserWithToken($admin);

        $response = $this->postJson('/tickets', [
            'title' => 'Reopen Test',
            'description' => 'Will be closed then reopened',
            'priority' => 'média',
        ]);
        $ticketId = $response->json('ticket.id');

        $ticket = Ticket::find($ticketId);

        $closedStatus = TicketStatus::where('name', 'fechada')->first();
        $ticket->update([
            'status_id' => $closedStatus->id,
            'closed_at' => now(),
        ]);

        $ticket->refresh();
        $this->assertTrue($ticket->hasStatus(TicketStatusEnum::Closed));

        $result = app(TicketWorkflowService::class)->reopen($ticket);
        $this->assertTrue($result);
        $ticket->refresh();
        $this->assertTrue($ticket->hasStatus(TicketStatusEnum::Open));
        $this->assertNotNull($ticket->reopened_at);
        $this->assertNull($ticket->closed_at);
    }
}
