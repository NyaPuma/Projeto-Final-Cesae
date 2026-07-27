<?php

namespace Tests\Unit;

use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketStatusTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
    }

    #[Test]
    public function it_creates_status_with_valid_data(): void
    {
        $type = TicketType::create([
            'name' => 'avaria',
            'description' => 'Avaria',
        ]);

        $status = TicketStatus::create([
            'name' => Ticket::STATUS_OPEN,
            'description' => 'Ticket aberto aguardando atribuição',
            'type_id' => $type->id,
        ]);

        $this->assertNotNull($status->id);
        $this->assertEquals(Ticket::STATUS_OPEN, $status->name);
        $this->assertEquals($type->id, $status->type_id);
    }

    #[Test]
    public function it_belongs_to_a_type(): void
    {
        $type = TicketType::create([
            'name' => 'preventiva',
            'description' => 'Manutenção Preventiva',
        ]);

        $status = TicketStatus::create([
            'name' => Ticket::STATUS_IN_PROGRESS,
            'description' => 'Em execução',
            'type_id' => $type->id,
        ]);

        $this->assertInstanceOf(TicketType::class, $status->type);
        $this->assertEquals('preventiva', $status->type->name);
    }

    #[Test]
    public function it_has_many_tickets(): void
    {
        $type = TicketType::create(['name' => 'avaria', 'description' => 'Avaria']);
        $status = TicketStatus::create([
            'name' => Ticket::STATUS_OPEN,
            'description' => 'Aberto',
            'type_id' => $type->id,
        ]);
        $user = User::factory()->create();

        Ticket::create([
            'title' => 'Ticket 1',
            'description' => 'First ticket',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'user_id' => $user->id,
            'status_id' => $status->id,
            'opened_at' => now(),
        ]);

        Ticket::create([
            'title' => 'Ticket 2',
            'description' => 'Second ticket',
            'priority' => Ticket::PRIORITY_HIGH,
            'user_id' => $user->id,
            'status_id' => $status->id,
            'opened_at' => now(),
        ]);

        $this->assertCount(2, $status->tickets);
        $this->assertInstanceOf(Ticket::class, $status->tickets->first());
    }

    #[Test]
    public function it_has_fillable_attributes(): void
    {
        $status = new TicketStatus;
        $fillable = $status->getFillable();

        $this->assertContains('name', $fillable);
        $this->assertContains('description', $fillable);
        $this->assertContains('type_id', $fillable);
    }

    #[Test]
    public function it_requires_unique_name(): void
    {
        $type = TicketType::create(['name' => 'avaria', 'description' => 'Avaria']);

        TicketStatus::create([
            'name' => Ticket::STATUS_OPEN,
            'description' => 'First open status',
            'type_id' => $type->id,
        ]);

        $this->expectException(QueryException::class);
        TicketStatus::create([
            'name' => Ticket::STATUS_OPEN,
            'description' => 'Duplicate open status',
            'type_id' => $type->id,
        ]);
    }
}
