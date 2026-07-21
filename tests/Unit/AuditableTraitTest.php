<?php

namespace Tests\Unit;

use App\Models\Audit;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AuditableTraitTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        TicketType::firstOrCreate(['name' => 'avaria', 'description' => 'Avaria']);
        $typeId = TicketType::where('name', 'avaria')->first()->id;
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_OPEN, 'description' => 'Aberto', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_IN_PROGRESS, 'description' => 'Em Curso', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_CLOSED, 'description' => 'Fechado', 'type_id' => $typeId]);
        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
    }

    #[Test]
    public function it_creates_audit_log_on_ticket_creation(): void
    {
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $user = User::factory()->create();

        $ticket = Ticket::create([
            'title'       => 'Audit Create Test',
            'description' => 'Testing audit creation',
            'priority'    => Ticket::PRIORITY_MEDIUM,
            'user_id'     => $user->id,
            'status_id'   => $openStatusId,
            'opened_at'   => now(),
        ]);

        $audit = Audit::where('auditable_id', $ticket->id)
            ->where('auditable_type', Ticket::class)
            ->where('event', 'created')
            ->first();

        $this->assertNotNull($audit);
        $this->assertEquals('created', $audit->event);
        $this->assertNotNull($audit->new_values);
        $this->assertNull($audit->old_values);
    }

    #[Test]
    public function it_creates_audit_log_on_ticket_update(): void
    {
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $user = User::factory()->create();
        $ticket = Ticket::create([
            'title'       => 'Audit Update Test',
            'description' => 'Original description',
            'priority'    => Ticket::PRIORITY_LOW,
            'user_id'     => $user->id,
            'status_id'   => $openStatusId,
            'opened_at'   => now(),
        ]);

        $ticket->update(['priority' => Ticket::PRIORITY_HIGH]);

        $audit = Audit::where('auditable_id', $ticket->id)
            ->where('auditable_type', Ticket::class)
            ->where('event', 'updated')
            ->first();

        $this->assertNotNull($audit);
        $this->assertEquals('updated', $audit->event);
        $this->assertNotNull($audit->old_values);
        $this->assertNotNull($audit->new_values);
        $this->assertEquals(Ticket::PRIORITY_LOW, $audit->old_values['priority']);
        $this->assertEquals(Ticket::PRIORITY_HIGH, $audit->new_values['priority']);
    }

    #[Test]
    public function it_creates_audit_log_on_ticket_deletion(): void
    {
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $user = User::factory()->create();
        $ticket = Ticket::create([
            'title'       => 'Audit Delete Test',
            'description' => 'Testing audit deletion',
            'priority'    => Ticket::PRIORITY_MEDIUM,
            'user_id'     => $user->id,
            'status_id'   => $openStatusId,
            'opened_at'   => now(),
        ]);

        $ticketId = $ticket->id;
        $ticket->delete();

        $audit = Audit::where('auditable_id', $ticketId)
            ->where('auditable_type', Ticket::class)
            ->where('event', 'deleted')
            ->first();

        $this->assertNotNull($audit);
        $this->assertEquals('deleted', $audit->event);
        $this->assertNotNull($audit->old_values);
        $this->assertNull($audit->new_values);
    }

    #[Test]
    public function it_creates_audit_with_request_metadata(): void
    {
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $user = User::factory()->create();

        $ticket = Ticket::create([
            'title'       => 'Audit Metadata Test',
            'description' => 'Testing audit metadata',
            'priority'    => Ticket::PRIORITY_HIGH,
            'user_id'     => $user->id,
            'status_id'   => $openStatusId,
            'opened_at'   => now(),
        ]);

        $audit = Audit::where('auditable_id', $ticket->id)
            ->where('auditable_type', Ticket::class)
            ->where('event', 'created')
            ->first();

        $this->assertNotNull($audit);
    }

    #[Test]
    public function it_handles_audit_without_authenticated_user(): void
    {
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $user = User::factory()->create();

        $ticket = Ticket::create([
            'title'       => 'No Auth Audit',
            'description' => 'Testing audit without auth',
            'priority'    => Ticket::PRIORITY_LOW,
            'user_id'     => $user->id,
            'status_id'   => $openStatusId,
            'opened_at'   => now(),
        ]);

        $audit = Audit::where('auditable_id', $ticket->id)
            ->where('auditable_type', Ticket::class)
            ->where('event', 'created')
            ->first();

        $this->assertNotNull($audit);
        $this->assertNull($audit->user_id);
    }

    #[Test]
    public function it_does_not_break_on_audit_failure(): void
    {
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $user = User::factory()->create();

        $ticket = Ticket::create([
            'title'       => 'Audit Failure Test',
            'description' => 'Should not break on audit failure',
            'priority'    => Ticket::PRIORITY_MEDIUM,
            'user_id'     => $user->id,
            'status_id'   => $openStatusId,
            'opened_at'   => now(),
        ]);

        $this->assertNotNull($ticket);
        $this->assertEquals('Audit Failure Test', $ticket->title);
    }

    #[Test]
    public function it_creates_audit_with_correct_structure(): void
    {
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $user = User::factory()->create();

        $ticket = Ticket::create([
            'title'       => 'Audit Structure Test',
            'description' => 'Testing audit structure',
            'priority'    => Ticket::PRIORITY_MEDIUM,
            'user_id'     => $user->id,
            'status_id'   => $openStatusId,
            'opened_at'   => now(),
        ]);

        $audit = Audit::where('auditable_id', $ticket->id)
            ->where('auditable_type', Ticket::class)
            ->where('event', 'created')
            ->first();

        $this->assertNotNull($audit);
        $this->assertArrayHasKey('title', $audit->new_values);
        $this->assertArrayHasKey('description', $audit->new_values);
        $this->assertArrayHasKey('priority', $audit->new_values);
        $this->assertArrayHasKey('user_id', $audit->new_values);
        $this->assertArrayHasKey('status_id', $audit->new_values);
    }
}
