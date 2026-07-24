<?php

namespace Tests\Unit;

use App\Exports\TicketsExport;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketCountDebugTest extends TestCase
{
    use RefreshDatabase;

    public function test_count_debug(): void
    {
        TicketType::firstOrCreate(['name' => 'avaria', 'description' => 'Avaria']);
        $typeId = TicketType::where('name', 'avaria')->first()->id;
        TicketStatus::firstOrCreate(['name' => Ticket::STATUS_OPEN, 'description' => 'Aberto', 'type_id' => $typeId]);
        UserProfile::firstOrCreate(['name' => User::ROLE_USER]);

        $user = User::factory()->create();
        $openStatusId = Ticket::getStatusIdByName(Ticket::STATUS_OPEN);

        $ticket1 = Ticket::create([
            'title' => 'First Ticket',
            'description' => 'Older ticket',
            'priority' => Ticket::PRIORITY_MEDIUM,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now()->subDay(),
            'created_at' => now()->subDay(),
        ]);

        $ticket2 = Ticket::create([
            'title' => 'Second Ticket',
            'description' => 'Newer ticket',
            'priority' => Ticket::PRIORITY_HIGH,
            'user_id' => $user->id,
            'status_id' => $openStatusId,
            'opened_at' => now(),
            'created_at' => now(),
        ]);

        dump('DB count: '.Ticket::count());

        $export = new TicketsExport;
        $results = $export->query()->get();

        dump('Export query count: '.$results->count());
        dump('Export query ids: '.implode(', ', $results->pluck('id')->toArray()));

        $rawQuery = Ticket::query()
            ->select(['id', 'title', 'status_id', 'priority', 'opened_at', 'in_progress_at', 'closed_at', 'minutes_spent', 'cost', 'budget_status', 'budget_amount'])
            ->orderBy('created_at', 'desc')
            ->get();
        dump('Raw select count: '.$rawQuery->count());

        $simpleQuery = Ticket::query()->get();
        dump('Simple query count: '.$simpleQuery->count());

        $this->assertCount(2, $results);
    }
}
