<?php

namespace Tests\Unit;

use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seedLookupData();
    }

    private function seedLookupData(): void
    {
        // Create ticket types
        TicketType::firstOrCreate(['name' => 'avaria', 'description' => 'Avaria']);
        TicketType::firstOrCreate(['name' => 'preventiva', 'description' => 'Manutenção Preventiva']);

        // Create ticket statuses
        $typeId = TicketType::where('name', 'avaria')->first()->id;
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_OPEN, 'description' => 'Aberto', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_IN_PROGRESS, 'description' => 'Em Curso', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_CLOSED, 'description' => 'Fechado', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_CANCELLED, 'description' => 'Cancelado', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_PENDING_BUDGET, 'description' => 'Pendente Orçamento', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_REJECTED, 'description' => 'Recusada', 'type_id' => $typeId]);

        // Create user profiles
        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
    }

    #[Test]
    public function it_has_correct_status_constants(): void
    {
        $this->assertEquals('aberta', Ticket::STATUS_OPEN);
        $this->assertEquals('em curso', Ticket::STATUS_IN_PROGRESS);
        $this->assertEquals('fechada', Ticket::STATUS_CLOSED);
        $this->assertEquals('cancelada', Ticket::STATUS_CANCELLED);
        $this->assertEquals('pendente orçamento', Ticket::STATUS_PENDING_BUDGET);
        $this->assertEquals('recusada', Ticket::STATUS_REJECTED);
    }

    #[Test]
    public function it_has_correct_priority_constants(): void
    {
        $this->assertEquals('baixa', Ticket::PRIORITY_LOW);
        $this->assertEquals('média', Ticket::PRIORITY_MEDIUM);
        $this->assertEquals('alta', Ticket::PRIORITY_HIGH);
    }

    #[Test]
    public function it_has_correct_budget_constants(): void
    {
        $this->assertEquals('pending', Ticket::BUDGET_PENDING);
        $this->assertEquals('approved', Ticket::BUDGET_APPROVED);
        $this->assertEquals('rejected', Ticket::BUDGET_REJECTED);
    }

    #[Test]
    public function it_creates_a_ticket_with_valid_data(): void
    {
        $user = User::factory()->create();
        $statusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'title' => 'Test Ticket',
            'description' => 'Test Description',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'user_id' => $user->id,
            'status_id' => $statusId,
            'opened_at' => now(),
        ]);

        $this->assertNotNull($ticket->id);
        $this->assertEquals('Test Ticket', $ticket->title);
        $this->assertEquals('Test Description', $ticket->description);
        $this->assertEquals(Ticket::PRIORITY_MEDIUM, $ticket->priority);
        $this->assertEquals($user->id, $ticket->user_id);
    }

    #[Test]
    public function it_gets_status_id_by_name(): void
    {
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $this->assertNotNull($openStatusId);

        $closedStatusId = Ticket::getStatusIdByName(Ticket::STATUS_CLOSED);
        $this->assertNotNull($closedStatusId);

        $nonExistentStatusId = Ticket::getStatusIdByName('non_existent');
        $this->assertNull($nonExistentStatusId);
    }

    #[Test]
    public function it_checks_has_status_correctly(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'title' => 'Status Check Ticket',
            'description' => 'Testing status check',
            'priority' => Ticket::PRIORITY_LOW,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_OPEN));
        $this->assertFalse($ticket->hasStatus(Ticket::STATUS_CLOSED));
        $this->assertFalse($ticket->hasStatus(Ticket::STATUS_IN_PROGRESS));
    }

    #[Test]
    public function it_starts_repair_correctly(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'title' => 'Repair Ticket',
            'description' => 'Testing repair start',
            'priority' => Ticket::PRIORITY_HIGH,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $result = $ticket->startRepair();

        $this->assertTrue($result);
        $ticket->refresh();
        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_IN_PROGRESS));
        $this->assertNotNull($ticket->in_progress_at);
    }

    #[Test]
    public function it_reopens_a_closed_ticket_correctly(): void
    {
        $user = User::factory()->create();
        $closedStatusId = Ticket::getStatusIdByName(Ticket::STATUS_CLOSED);

        $ticket = Ticket::create([
            'title' => 'Reopen Test',
            'description' => 'Testing reopen',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'user_id' => $user->id,
            'status_id' => $closedStatusId,
            'closed_at' => now(),
            'opened_at' => now()->subDays(1),
        ]);

        $result = $ticket->reopen();

        $this->assertTrue($result);
        $ticket->refresh();
        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_OPEN));
        $this->assertNull($ticket->closed_at);
        $this->assertNotNull($ticket->reopened_at);
    }

    #[Test]
    public function it_rejects_reopen_for_non_closed_tickets(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'title' => 'Non Closed Reopen',
            'description' => 'Should not reopen',
            'priority' => Ticket::PRIORITY_LOW,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $result = $ticket->reopen();
        $this->assertFalse($result);
    }

    #[Test]
    public function it_auto_closes_ticket_below_threshold(): void
    {
        $user = User::factory()->create();
        $inProgressStatusId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);

        $ticket = Ticket::create([
            'title' => 'Auto Close Test',
            'description' => 'Testing auto close',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'user_id' => $user->id,
            'status_id' => $inProgressStatusId,
            'cost' => 50.00,
            'opened_at' => now(),
            'in_progress_at' => now(),
        ]);

        $result = $ticket->checkAutoClose(100.00);

        $this->assertTrue($result);
        $ticket->refresh();
        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_CLOSED));
        $this->assertNotNull($ticket->closed_at);
    }

    #[Test]
    public function it_skips_auto_close_when_cost_exceeds_threshold(): void
    {
        $user = User::factory()->create();
        $inProgressStatusId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);

        $ticket = Ticket::create([
            'title' => 'Skip Auto Close',
            'description' => 'Cost exceeds threshold',
            'priority' => Ticket::PRIORITY_HIGH,
            'user_id' => $user->id,
            'status_id' => $inProgressStatusId,
            'cost' => 200.00,
            'opened_at' => now(),
            'in_progress_at' => now(),
        ]);

        $result = $ticket->checkAutoClose(100.00);

        $this->assertFalse($result);
        $ticket->refresh();
        $this->assertFalse($ticket->hasStatus(Ticket::STATUS_CLOSED));
    }

    #[Test]
    public function it_requests_budget_authorization_when_cost_exceeds_threshold(): void
    {
        $user = User::factory()->create();
        $inProgressStatusId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);

        $ticket = Ticket::create([
            'title' => 'Budget Request Test',
            'description' => 'Testing budget request',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'user_id' => $user->id,
            'status_id' => $inProgressStatusId,
            'opened_at' => now(),
            'in_progress_at' => now(),
        ]);

        $result = $ticket->requestBudgetAuthorization(5000.00, 1000.00);

        $this->assertTrue($result);
        $ticket->refresh();
        $this->assertTrue($ticket->budget_requested);
        $this->assertEquals(Ticket::BUDGET_PENDING, $ticket->budget_status);
        $this->assertEquals(5000.00, $ticket->budget_amount);
        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_PENDING_BUDGET));
        $this->assertNotNull($ticket->budget_requested_at);
    }

    #[Test]
    public function it_skips_budget_request_when_below_threshold(): void
    {
        $user = User::factory()->create();
        $inProgressStatusId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);

        $ticket = Ticket::create([
            'title' => 'Skip Budget',
            'description' => 'Below threshold',
            'priority' => Ticket::PRIORITY_LOW,
            'user_id' => $user->id,
            'status_id' => $inProgressStatusId,
            'opened_at' => now(),
            'in_progress_at' => now(),
        ]);

        $result = $ticket->requestBudgetAuthorization(500.00, 1000.00);

        $this->assertFalse($result);
        $ticket->refresh();
        $this->assertFalse($ticket->budget_requested);
    }

    #[Test]
    public function it_approves_budget_as_admin(): void
    {
        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->first();
        $admin = User::factory()->create(['profile_id' => $adminProfile->id]);

        $inProgressStatusId = Ticket::getStatusIdByName(Ticket::STATUS_IN_PROGRESS);
        $user = User::factory()->create();

        $ticket = Ticket::create([
            'title' => 'Approve Budget',
            'description' => 'Testing budget approval',
            'priority' => Ticket::PRIORITY_HIGH,
            'user_id' => $user->id,
            'status_id' => $inProgressStatusId,
            'opened_at' => now(),
            'in_progress_at' => now(),
        ]);

        $result = $ticket->approveBudget($admin, 'approve');

        $this->assertTrue($result);
        $ticket->refresh();
        $this->assertEquals(Ticket::BUDGET_APPROVED, $ticket->budget_status);
        $this->assertEquals($admin->id, $ticket->budget_approved_by);
        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_IN_PROGRESS));
        $this->assertNotNull($ticket->budget_decided_at);
    }

    #[Test]
    public function it_rejects_budget_as_admin(): void
    {
        $adminProfile = UserProfile::where('name', User::ROLE_ADMIN)->first();
        $admin = User::factory()->create(['profile_id' => $adminProfile->id]);

        $pendingBudgetStatusId = Ticket::getStatusIdByName(Ticket::STATUS_PENDING_BUDGET);
        $user = User::factory()->create();

        $ticket = Ticket::create([
            'title' => 'Reject Budget',
            'description' => 'Testing budget rejection',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'user_id' => $user->id,
            'status_id' => $pendingBudgetStatusId,
            'opened_at' => now(),
        ]);

        $result = $ticket->approveBudget($admin, 'reject', 'Orçamento demasiado alto');

        $this->assertTrue($result);
        $ticket->refresh();
        $this->assertEquals(Ticket::BUDGET_REJECTED, $ticket->budget_status);
        $this->assertEquals($admin->id, $ticket->budget_approved_by);
        $this->assertTrue($ticket->hasStatus(Ticket::STATUS_REJECTED));
        $this->assertEquals('Orçamento demasiado alto', $ticket->budget_feedback);
    }

    #[Test]
    public function it_rejects_budget_approval_from_non_admin(): void
    {
        $operatorProfile = UserProfile::where('name', User::ROLE_USER)->first();
        $operator = User::factory()->create(['profile_id' => $operatorProfile->id]);

        $pendingBudgetStatusId = Ticket::getStatusIdByName(Ticket::STATUS_PENDING_BUDGET);
        $user = User::factory()->create();

        $ticket = Ticket::create([
            'title' => 'Non Admin Budget',
            'description' => 'Should reject',
            'priority' => Ticket::PRIORITY_LOW,
            'user_id' => $user->id,
            'status_id' => $pendingBudgetStatusId,
            'opened_at' => now(),
        ]);

        $result = $ticket->approveBudget($operator, 'approve');

        $this->assertFalse($result);
    }

    #[Test]
    public function it_calculates_budget_pause_minutes(): void
    {
        $user = User::factory()->create();

        $ticket = Ticket::create([
            'title' => 'Pause Time Test',
            'description' => 'Testing pause calculation',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'user_id' => $user->id,
            'opened_at' => now()->subDays(2),
            'budget_requested_at' => now()->subDay(),
            'budget_decided_at' => now(),
        ]);

        $pauseMinutes = $ticket->getBudgetPauseMinutesAttribute();
        $this->assertGreaterThan(0, $pauseMinutes);
        $this->assertLessThanOrEqual(1440, $pauseMinutes); // Max 1 day = 1440 min
    }

    #[Test]
    public function it_returns_zero_pause_minutes_when_no_budget_dates(): void
    {
        $user = User::factory()->create();

        $ticket = Ticket::create([
            'title' => 'No Pause',
            'description' => 'No budget dates',
            'priority' => Ticket::PRIORITY_LOW,
            'user_id' => $user->id,
            'opened_at' => now(),
        ]);

        $pauseMinutes = $ticket->getBudgetPauseMinutesAttribute();
        $this->assertEquals(0, $pauseMinutes);
    }

    #[Test]
    public function it_gets_scheduled_events(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        Ticket::create([
            'title' => 'Scheduled Event 1',
            'description' => 'First scheduled',
            'priority' => Ticket::PRIORITY_HIGH,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'scheduled_at' => now()->addDays(2),
            'scheduled_end' => now()->addDays(2)->addHours(4),
            'scheduled' => true,
            'opened_at' => now(),
        ]);

        Ticket::create([
            'title' => 'Scheduled Event 2',
            'description' => 'Second scheduled',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'scheduled_at' => now()->addDays(5),
            'scheduled' => true,
            'opened_at' => now(),
        ]);

        $events = Ticket::getScheduledEvents();
        $this->assertCount(2, $events);

        foreach ($events as $event) {
            $this->assertArrayHasKey('id', $event);
            $this->assertArrayHasKey('title', $event);
            $this->assertArrayHasKey('start', $event);
            $this->assertArrayHasKey('end', $event);
        }
    }

    #[Test]
    public function it_uses_guarded_property(): void
    {
        $ticket = new Ticket;
        $this->assertEquals([], $ticket->getGuarded());
    }

    #[Test]
    public function it_has_correct_casts(): void
    {
        $ticket = new Ticket;
        $casts = $ticket->getCasts();

        $this->assertArrayHasKey('opened_at', $casts);
        $this->assertEquals('datetime', $casts['opened_at']);
        $this->assertArrayHasKey('scheduled', $casts);
        $this->assertEquals('boolean', $casts['scheduled']);
        $this->assertArrayHasKey('budget_requested', $casts);
        $this->assertEquals('boolean', $casts['budget_requested']);
    }

    #[Test]
    public function it_has_correct_relationships(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'title' => 'Relation Test',
            'description' => 'Testing relationships',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $this->assertInstanceOf(User::class, $ticket->user);
        $this->assertInstanceOf(TicketStatus::class, $ticket->status);
        $this->assertInstanceOf(HasMany::class, $ticket->comments());
        $this->assertInstanceOf(HasMany::class, $ticket->attachments());
        $this->assertInstanceOf(HasMany::class, $ticket->workflowHistory());
    }

    #[Test]
    public function it_uses_soft_deletes(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'title' => 'Soft Delete Test',
            'description' => 'Testing soft delete',
            'priority' => Ticket::PRIORITY_LOW,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $ticketId = $ticket->id;
        $ticket->delete();

        $this->assertNotNull($ticket->deleted_at);
        $this->assertNull(Ticket::find($ticketId));
        $this->assertNotNull(Ticket::withTrashed()->find($ticketId));
    }
}
