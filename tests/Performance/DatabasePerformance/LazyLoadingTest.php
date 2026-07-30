<?php

namespace Tests\Performance\DatabasePerformance;


use App\Enums\UserRoleEnum;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LazyLoadingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::Technician->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);
    }

    #[Test]
    public function it_detects_lazy_loading_on_ticket_user(): void
    {
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);

        DB::enableQueryLog();

        $ticket = Ticket::first();
        $userName = $ticket->user->name; // Lazy loading

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertEquals(2, $queryCount, "Lazy loading detected: {$queryCount} queries");
    }

    #[Test]
    public function it_prevents_lazy_loading_with_eager_loading(): void
    {
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);

        DB::enableQueryLog();

        $ticket = Ticket::with('user')->first();
        $userName = $ticket->user->name; // No additional query

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertLessThanOrEqual(2, $queryCount, "Expected <= 2 queries, got {$queryCount}");
    }

    #[Test]
    public function it_detects_lazy_loading_on_ticket_equipment(): void
    {
        $room = Room::factory()->create();
        $equipment = Equipment::factory()->create(['room_id' => $room->id]);
        $ticket = Ticket::factory()->create(['equipment_id' => $equipment->id]);

        DB::enableQueryLog();

        $ticket = Ticket::first();
        $equipmentName = $ticket->equipment->name; // Lazy loading

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertEquals(2, $queryCount, "Lazy loading detected: {$queryCount} queries");
    }

    #[Test]
    public function it_detects_lazy_loading_on_equipment_room(): void
    {
        $room = Room::factory()->create();
        $equipment = Equipment::factory()->create(['room_id' => $room->id]);

        DB::enableQueryLog();

        $equipment = Equipment::first();
        $roomName = $equipment->room->name; // Lazy loading

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertEquals(2, $queryCount, "Lazy loading detected: {$queryCount} queries");
    }

    #[Test]
    public function it_prevents_lazy_loading_with_nested_eager_loading(): void
    {
        $room = Room::factory()->create();
        $equipment = Equipment::factory()->create(['room_id' => $room->id]);
        $ticket = Ticket::factory()->create(['equipment_id' => $equipment->id]);

        DB::enableQueryLog();

        $ticket = Ticket::with('equipment.room')->first();
        $roomName = $ticket->equipment->room->name; // No additional query

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertLessThanOrEqual(3, $queryCount, "Expected <= 3 queries, got {$queryCount}");
    }

    #[Test]
    public function it_measures_lazy_loading_performance_impact(): void
    {
        $users = User::factory()->count(50)->create();
        $tickets = [];

        foreach ($users as $user) {
            $tickets[] = Ticket::factory()->create(['user_id' => $user->id]);
        }

        // Test with lazy loading
        DB::enableQueryLog();
        $startTime = microtime(true);

        $tickets = Ticket::all();
        foreach ($tickets as $ticket) {
            $ticket->user->name;
        }

        $lazyTime = microtime(true) - $startTime;
        $lazyQueries = count(DB::getQueryLog());
        DB::disableQueryLog();

        // Test with eager loading
        DB::enableQueryLog();
        $startTime = microtime(true);

        $tickets = Ticket::with('user')->get();
        foreach ($tickets as $ticket) {
            $ticket->user->name;
        }

        $eagerTime = microtime(true) - $startTime;
        $eagerQueries = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertLessThan($lazyTime, $eagerTime, 'Eager loading should be faster');
    }
}
