<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\TicketType;
use App\Models\TicketStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
