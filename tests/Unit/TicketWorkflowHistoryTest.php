<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\TicketWorkflowHistory;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TicketWorkflowHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_workflow_history_relationships()
    {
        $ticket = Ticket::factory()->create();
        $statusA = TicketStatus::factory()->create(['name' => 'Aberto']);
        $statusB = TicketStatus::factory()->create(['name' => 'Em Curso']);
        $techProfile = UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        $technician = User::factory()->create(['profile_id' => $techProfile->id]);

        $history = TicketWorkflowHistory::create([
            'ticket_id' => $ticket->id,
            'origin_status_id' => $statusA->id,
            'destination_status_id' => $statusB->id,
            'technician_id' => $technician->id,
            'comment' => 'Início dos trabalhos',
        ]);

        $this->assertEquals($ticket->id, $history->ticket->id);
        $this->assertEquals($statusA->id, $history->originStatus->id);
        $this->assertEquals($statusB->id, $history->destinationStatus->id);
        $this->assertEquals($technician->id, $history->technician->id);
        $this->assertEquals('Início dos trabalhos', $history->comment);
    }
}
