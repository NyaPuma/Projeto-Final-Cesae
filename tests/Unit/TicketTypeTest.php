<?php

namespace Tests\Unit;

use App\Models\TicketStatus;
use App\Models\TicketType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_ticket_type_has_statuses_relationship()
    {
        $type = TicketType::factory()->create(['name' => 'Preventiva']);
        $status = TicketStatus::factory()->create(['type_id' => $type->id]);

        $this->assertTrue($type->statuses->contains($status));
    }
}
