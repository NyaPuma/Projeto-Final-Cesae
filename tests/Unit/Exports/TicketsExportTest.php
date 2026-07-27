<?php

namespace Tests\Unit;

use App\Exports\TicketsExport;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketsExportTest extends TestCase
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
    }

    #[Test]
    public function it_returns_correct_headings(): void
    {
        $export = new TicketsExport;
        $headings = $export->headings();

        $expectedHeadings = [
            'ID',
            'Título',
            'Estado',
            'Prioridade',
            'Aberto em',
            'Em Progresso em',
            'Fechado em',
            'Minutos Gastos',
            'Custo (€)',
            'Estado Orçamento',
            'Montante Orçamento (€)',
        ];

        $this->assertEquals($expectedHeadings, $headings);
    }

    #[Test]
    public function it_returns_correct_title(): void
    {
        $export = new TicketsExport;
        $this->assertEquals('Relatório de Tickets', $export->title());
    }

    #[Test]
    public function it_maps_ticket_correctly(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);
        $status = TicketStatus::find($openStatusId);

        $ticket = Ticket::create([
            'title' => 'Export Test Ticket',
            'description' => 'Testing export mapping',
            'priority' => Ticket::PRIORITY_HIGH,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
            'minutes_spent' => 120,
            'cost' => 350.50,
            'budget_status' => Ticket::BUDGET_APPROVED,
            'budget_amount' => 500.00,
        ]);

        $export = new TicketsExport;
        $mapped = $export->map($ticket);

        $this->assertCount(11, $mapped);
        $this->assertEquals($ticket->id, $mapped[0]);
        $this->assertEquals('Export Test Ticket', $mapped[1]);
        $this->assertEquals($status->name, $mapped[2]);
        $this->assertEquals(Ticket::PRIORITY_HIGH, $mapped[3]);
        $this->assertEquals(120, $mapped[7]);
        $this->assertEquals('350,50', $mapped[8]);
        $this->assertEquals(Ticket::BUDGET_APPROVED, $mapped[9]);
        $this->assertEquals('500,00', $mapped[10]);
    }

    #[Test]
    public function it_handles_null_dates_in_mapping(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket = Ticket::create([
            'title' => 'Null Dates Ticket',
            'description' => 'Testing null dates',
            'priority' => Ticket::PRIORITY_LOW,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $export = new TicketsExport;
        $mapped = $export->map($ticket);

        $this->assertCount(11, $mapped);
        $this->assertEquals('N/A', $mapped[9]); // budget_status
        $this->assertEquals('0,00', $mapped[8]); // cost
        $this->assertEquals('0,00', $mapped[10]); // budget_amount
    }

    #[Test]
    public function it_returns_query_with_eager_loading(): void
    {
        $export = new TicketsExport;
        $query = $export->query();

        $this->assertInstanceOf(Builder::class, $query);
    }

    #[Test]
    public function it_returns_styles_array(): void
    {
        $export = new TicketsExport;
        $styles = $export->styles($this->createMock(Worksheet::class));

        $this->assertArrayHasKey(1, $styles);
        $this->assertArrayHasKey('font', $styles[1]);
        $this->assertArrayHasKey('fill', $styles[1]);
        $this->assertArrayHasKey('alignment', $styles[1]);
    }

    #[Test]
    public function it_orders_by_created_at_descending(): void
    {
        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket1 = Ticket::forceCreate([
            'title' => 'First Ticket',
            'description' => 'Older ticket',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now()->subDay(),
            'created_at' => now()->subDay(),
            'updated_at' => now()->subDay(),
        ]);

        $ticket2 = Ticket::forceCreate([
            'title' => 'Second Ticket',
            'description' => 'Newer ticket',
            'priority' => Ticket::PRIORITY_HIGH,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $export = new TicketsExport;
        $results = $export->query()->get();

        $this->assertCount(2, $results);
        $this->assertEquals($ticket2->id, $results->first()->id);
        $this->assertEquals($ticket1->id, $results->last()->id);
    }
}
