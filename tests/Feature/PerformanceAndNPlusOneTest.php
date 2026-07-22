<?php

namespace Tests\Feature;

use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PerformanceAndNPlusOneTest extends TestCase
{
    use RefreshDatabase;

    public function test_tickets_listing_uses_eager_loading_without_n_plus_one_queries()
    {
        $techProfile = UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        $technician = User::factory()->create(['profile_id' => $techProfile->id]);
        $room = Room::factory()->create();
        $equipment = Equipment::factory()->create(['room_id' => $room->id]);

        // Create 10 tickets
        Ticket::factory()->count(10)->create([
            'equipment_id' => $equipment->id,
            'room_id' => $room->id,
            'assigned_to' => $technician->id,
        ]);

        DB::flushQueryLog();
        DB::enableQueryLog();

        $this->actingAs($technician)
            ->getJson('/api/tickets');

        $queryCount = count(DB::getQueryLog());

        // The query count should remain low and constant regardless of ticket quantity
        $this->assertLessThan(15, $queryCount, "Listing 10 tickets produced {$queryCount} queries, possible N+1 issue!");
    }
}
