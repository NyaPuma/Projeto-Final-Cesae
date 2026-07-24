<?php

namespace Tests\Feature;

use App\Models\Equipment;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DatabaseIntegrityTest extends TestCase
{
    use RefreshDatabase;

    public function test_deleting_room_with_associated_equipments_handles_null_on_delete_or_foreign_key_protection()
    {
        $room = Room::factory()->create();
        $equipment = Equipment::factory()->create(['room_id' => $room->id]);

        $this->assertEquals($room->id, $equipment->fresh()->room_id);

        $room->delete();

        $this->assertSoftDeleted('rooms', ['id' => $room->id]);

        $equipment = $equipment->fresh();
        $this->assertNotNull($equipment->room_id, 'Equipment room_id preserved after room soft delete');
    }

    public function test_unique_constraints_are_enforced()
    {
        $user1 = User::factory()->create(['email' => 'duplicado@empresa.pt']);

        $this->expectException(QueryException::class);

        User::create([
            'name' => 'Duplicado User',
            'email' => 'duplicado@empresa.pt',
            'password' => Hash::make('password123'),
        ]);
    }
}
