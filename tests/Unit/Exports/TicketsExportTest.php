<?php

namespace Tests\Unit;


use App\Enums\UserRoleEnum;
use App\Enums\BudgetStatusEnum;
use App\Enums\TicketPriorityEnum;
use App\Enums\TicketStatusEnum;
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
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::Open->value, 'description' => 'Aberto', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::InProgress->value, 'description' => 'Em Curso', 'type_id' => $typeId]);
        TicketStatus::firstOrCreate(['name' => TicketStatusEnum::Closed->value, 'description' => 'Fechado', 'type_id' => $typeId]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);
    }

    #[Test]
    public function it_returns_correct_headings(): void
    {
        $export = new TicketsExport;
        $headings = $export->headings();

        $expectedHeadings = [
            'ID',
            'Código',
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
        $openStatusId = TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id');
        $status = TicketStatus::find($openStatusId);

        $ticket = Ticket::create([
            'title' => 'Export Test Ticket',
            'description' => 'Testing export mapping',
            'priority' => TicketPriorityEnum::High->value,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
            'minutes_spent' => 120,
            'actual_cost' => 350.50,
            'budget_status' => BudgetStatusEnum::Approved->value,
            'budget_amount' => 500.00,
        ]);

        $ticket->refresh();

        $export = new TicketsExport;
        $mapped = $export->map($ticket);

        $this->assertCount(12, $mapped);
        $this->assertEquals($ticket->id, $mapped[0]);
        $this->assertEquals($ticket->reference, $mapped[1]);
        $this->assertEquals('Export Test Ticket', $mapped[2]);
        $this->assertEquals($status->name, $mapped[3]);
        $this->assertEquals(TicketPriorityEnum::High->value, $mapped[4]);
        $this->assertEquals(120, $mapped[8]);
        $this->assertEquals(350.50, $mapped[9]);
        $this->assertEquals(BudgetStatusEnum::Approved->value, $mapped[10]);
        $this->assertEquals(500.00, $mapped[11]);
    }

    #[Test]
    public function it_handles_null_dates_in_mapping(): void
    {
        $user = User::factory()->create();
        $openStatusId = TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id');

        $ticket = Ticket::create([
            'title' => 'Null Dates Ticket',
            'description' => 'Testing null dates',
            'priority' => TicketPriorityEnum::Low->value,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
        ]);

        $export = new TicketsExport;
        $mapped = $export->map($ticket);

        $this->assertCount(12, $mapped);
        $this->assertEquals('N/A', $mapped[10]); // budget_status
        $this->assertEquals(0.0, $mapped[9]); // cost
        $this->assertEquals(0.0, $mapped[11]); // budget_amount
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
        $openStatusId = TicketStatus::where('name', TicketStatusEnum::Open->value)->value('id');

        $ticket1 = Ticket::create([
            'title' => 'First Ticket',
            'description' => 'Older ticket',
            'priority' => TicketPriorityEnum::Medium->value,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now()->subDay(),
        ]);
        $ticket1->created_at = now()->subDay();
        $ticket1->save();

        $ticket2 = Ticket::create([
            'title' => 'Second Ticket',
            'description' => 'Newer ticket',
            'priority' => TicketPriorityEnum::High->value,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
            'created_at' => now(),
        ]);

        $export = new TicketsExport;
        $results = $export->query()->get();

        $this->assertCount(2, $results);
        $this->assertEquals($ticket2->id, $results->first()->id);
        $this->assertEquals($ticket1->id, $results->last()->id);
    }
}
