<?php

namespace Tests\Performance\DatabasePerformance;


use App\Enums\UserRoleEnum;
use App\Models\Equipment;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\TicketComment;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NPlusOneQueryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        UserProfile::firstOrCreate(['name' => UserRoleEnum::Admin->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::Technician->value]);
        UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);

        TicketStatus::firstOrCreate(['name' => 'aberta'], ['description' => 'Aberta']);
        TicketStatus::firstOrCreate(['name' => 'em curso'], ['description' => 'Em Curso']);
        TicketStatus::firstOrCreate(['name' => 'fechada'], ['description' => 'Fechada']);
    }

    #[Test]
    public function it_prevents_n_plus_one_when_loading_tickets_with_user(): void
    {
        $users = User::factory()->count(10)->create();
        $tickets = [];

        foreach ($users as $user) {
            $tickets[] = Ticket::factory()->create(['user_id' => $user->id]);
        }

        DB::enableQueryLog();

        Ticket::with('user')->get();

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertLessThanOrEqual(2, $queryCount, "Expected 2 queries, got {$queryCount}");
    }

    #[Test]
    public function it_prevents_n_plus_one_when_loading_tickets_with_comments(): void
    {
        $tickets = Ticket::factory()->count(10)->create();
        foreach ($tickets as $ticket) {
            TicketComment::factory()->count(3)->create(['ticket_id' => $ticket->id]);
        }

        DB::enableQueryLog();

        Ticket::with('comments')->get();

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertLessThanOrEqual(2, $queryCount, "Expected 2 queries, got {$queryCount}");
    }

    #[Test]
    public function it_prevents_n_plus_one_when_loading_tickets_with_equipment(): void
    {
        $rooms = Room::factory()->count(5)->create();
        $equipments = Equipment::factory()->count(20)->create();
        $tickets = [];

        foreach ($equipments as $equipment) {
            $tickets[] = Ticket::factory()->create(['equipment_id' => $equipment->id]);
        }

        DB::enableQueryLog();

        Ticket::with('equipment')->get();

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertLessThanOrEqual(2, $queryCount, "Expected 2 queries, got {$queryCount}");
    }

    #[Test]
    public function it_prevents_n_plus_one_when_loading_tickets_with_multiple_relations(): void
    {
        $users = User::factory()->count(10)->create();
        $rooms = Room::factory()->count(5)->create();
        $equipments = Equipment::factory()->count(20)->create();
        $tickets = [];

        foreach ($users as $user) {
            $tickets[] = Ticket::factory()->create([
                'user_id' => $user->id,
                'equipment_id' => $equipments->random()->id,
                'room_id' => $rooms->random()->id,
            ]);
        }

        DB::enableQueryLog();

        Ticket::with(['user', 'equipment', 'room', 'status'])->get();

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertLessThanOrEqual(5, $queryCount, "Expected 5 queries, got {$queryCount}");
    }

    #[Test]
    public function it_detects_n_plus_one_without_eager_loading(): void
    {
        $users = User::factory()->count(10)->create();
        $tickets = [];

        foreach ($users as $user) {
            $tickets[] = Ticket::factory()->create(['user_id' => $user->id]);
        }

        DB::enableQueryLog();

        $tickets = Ticket::all();
        foreach ($tickets as $ticket) {
            $user = $ticket->user; // This triggers N+1
        }

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertGreaterThan(10, $queryCount, "N+1 detected: {$queryCount} queries for 10 tickets");
    }

    #[Test]
    public function it_prevents_n_plus_one_with_eager_loading(): void
    {
        $users = User::factory()->count(10)->create();
        $tickets = [];

        foreach ($users as $user) {
            $tickets[] = Ticket::factory()->create(['user_id' => $user->id]);
        }

        DB::enableQueryLog();

        $tickets = Ticket::with('user')->get();
        foreach ($tickets as $ticket) {
            $user = $ticket->user; // No additional queries
        }

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertLessThanOrEqual(2, $queryCount, "Expected 2 queries, got {$queryCount}");
    }

    #[Test]
    public function it_prevents_n_plus_one_when_loading_comments_with_user(): void
    {
        $users = User::factory()->count(10)->create();
        $tickets = Ticket::factory()->count(5)->create();
        $comments = [];

        foreach ($tickets as $ticket) {
            foreach ($users as $user) {
                $comments[] = TicketComment::factory()->create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $user->id,
                ]);
            }
        }

        DB::enableQueryLog();

        TicketComment::with('user')->get();

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertLessThanOrEqual(2, $queryCount, "Expected 2 queries, got {$queryCount}");
    }

    #[Test]
    public function it_prevents_n_plus_one_when_loading_equipment_with_room(): void
    {
        $rooms = Room::factory()->count(5)->create();
        $equipments = Equipment::factory()->count(20)->create(['room_id' => $rooms->random()->id]);

        DB::enableQueryLog();

        Equipment::with('room')->get();

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertLessThanOrEqual(2, $queryCount, "Expected 2 queries, got {$queryCount}");
    }
}
