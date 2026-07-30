<?php

namespace Tests\Unit\Models;


use App\Enums\UserRoleEnum;
use App\Enums\BudgetStatusEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketAttributesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seedLookupData();
    }

    private function seedLookupData(): void
    {
        TicketType::firstOrCreate(['name' => 'avaria', 'description' => 'Avaria']);
        TicketType::firstOrCreate(['name' => 'preventiva', 'description' => 'ManutenÃ§Ã£o Preventiva']);

        $typeId = TicketType::where('name', 'avaria')->first()->id;
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::Open->value, 'description' => 'Aberto', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::InProgress->value, 'description' => 'Em Curso', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::Closed->value, 'description' => 'Fechado', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::Cancelled->value, 'description' => 'Cancelado', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::PendingBudget->value, 'description' => 'Pendente OrÃ§amento', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::Rejected->value, 'description' => 'Recusada', 'type_id' => $typeId]);

        UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::Technician->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
    }

    #[Test]
    public function it_has_correct_status_constants(): void
    {
        $this->assertEquals('aberta', TicketStatusEnum::Open->value);
        $this->assertEquals('em curso', TicketStatusEnum::InProgress->value);
        $this->assertEquals('fechada', TicketStatusEnum::Closed->value);
        $this->assertEquals('cancelada', TicketStatusEnum::Cancelled->value);
        $this->assertEquals('pendente orÃ§amento', TicketStatusEnum::PendingBudget->value);
        $this->assertEquals('recusada', TicketStatusEnum::Rejected->value);
    }

    #[Test]
    public function it_has_correct_priority_constants(): void
    {
        $this->assertEquals('baixa', TicketPriorityEnum::Low->value);
        $this->assertEquals('mÃ©dia', TicketPriorityEnum::Medium->value);
        $this->assertEquals('alta', TicketPriorityEnum::High->value);
    }

    #[Test]
    public function it_has_correct_budget_constants(): void
    {
        $this->assertEquals('pending', BudgetStatusEnum::Pending->value);
        $this->assertEquals('approved', BudgetStatusEnum::Approved->value);
        $this->assertEquals('rejected', BudgetStatusEnum::Rejected->value);
    }

    #[Test]
    public function it_creates_a_ticket_with_valid_data(): void
    {
        $user = User::factory()->create();
        $statusId = TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id');

        $ticket = Ticket::create([
            'title' => 'Test Ticket',
            'description' => 'Test Description',
            'priority' => TicketPriorityEnum::Medium->value,
            'user_id' => $user->id,
            'status_id' => $statusId,
            'opened_at' => now(),
        ]);

        $this->assertNotNull($ticket->id);
        $this->assertEquals('Test Ticket', $ticket->title);
        $this->assertEquals('Test Description', $ticket->description);
        $this->assertEquals(TicketPriorityEnum::Medium->value, $ticket->priority);
        $this->assertEquals($user->id, $ticket->user_id);
    }

    #[Test]
    public function it_gets_status_id_by_name(): void
    {
        $openStatusId = TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id');
        $this->assertNotNull($openStatusId);

        $closedStatusId = TicketStatus::where('name', TicketStatusEnum::Closed->value)->value('id');
        $this->assertNotNull($closedStatusId);

        $nonExistentStatusId = TicketStatus::where('name', 'non_existent')->value('id');
        $this->assertNull($nonExistentStatusId);
    }

    #[Test]
    public function it_checks_has_status_correctly(): void
    {
        $user = User::factory()->create();
        $openStatusId = TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id');

        $ticket = Ticket::create([
            'title' => 'Status Check Ticket',
            'description' => 'Testing status check',
            'priority' => TicketPriorityEnum::Low->value,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $this->assertTrue($ticket->hasStatus(TicketStatusEnum::Open));
        $this->assertFalse($ticket->hasStatus(TicketStatusEnum::Closed));
        $this->assertFalse($ticket->hasStatus(TicketStatusEnum::InProgress));
    }

    #[Test]
    public function it_calculates_budget_pause_minutes(): void
    {
        $user = User::factory()->create();

        $ticket = Ticket::create([
            'title' => 'Pause Time Test',
            'description' => 'Testing pause calculation',
            'priority' => TicketPriorityEnum::Medium->value,
            'user_id' => $user->id,
            'opened_at' => now()->subDays(2),
            'budget_requested_at' => now()->subDay(),
            'budget_decided_at' => now(),
        ]);

        $pauseMinutes = $ticket->getBudgetPauseMinutesAttribute();
        $this->assertGreaterThan(0, $pauseMinutes);
        $this->assertLessThanOrEqual(1440, $pauseMinutes);
    }

    #[Test]
    public function it_returns_zero_pause_minutes_when_no_budget_dates(): void
    {
        $user = User::factory()->create();

        $ticket = Ticket::create([
            'title' => 'No Pause',
            'description' => 'No budget dates',
            'priority' => TicketPriorityEnum::Low->value,
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
        $openStatusId = TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id');

        Ticket::create([
            'title' => 'Scheduled Event 1',
            'description' => 'First scheduled',
            'priority' => TicketPriorityEnum::High->value,
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
            'priority' => TicketPriorityEnum::Medium->value,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'scheduled_at' => now()->addDays(5),
            'scheduled' => true,
            'opened_at' => now(),
        ]);

        $events = Ticket::where('scheduled', true)->whereNotNull('scheduled_at')->get();
        $this->assertCount(2, $events);

        foreach ($events as $event) {
            $this->assertNotNull($event->id);
            $this->assertNotNull($event->title);
            $this->assertNotNull($event->scheduled_at);
        }
    }

    #[Test]
    public function it_uses_guarded_property(): void
    {
        $ticket = new Ticket;
        $fillable = $ticket->getFillable();

        $this->assertContains('title', $fillable);
        $this->assertContains('description', $fillable);
        $this->assertContains('priority', $fillable);
        $this->assertContains('user_id', $fillable);
        $this->assertContains('status_id', $fillable);
        $this->assertContains('assigned_to', $fillable);
        $this->assertContains('budget_status', $fillable);
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
        $openStatusId = TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id');

        $ticket = Ticket::create([
            'title' => 'Relation Test',
            'description' => 'Testing relationships',
            'priority' => TicketPriorityEnum::Medium->value,
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
        $openStatusId = TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id');

        $ticket = Ticket::create([
            'title' => 'Soft Delete Test',
            'description' => 'Testing soft delete',
            'priority' => TicketPriorityEnum::Low->value,
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
