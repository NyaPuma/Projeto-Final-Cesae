<?php

namespace Tests\Performance;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Room;
use App\Models\Ticket;
use App\Models\TicketStatus;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

abstract class PerformanceTestCase extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $technician;
    protected User $commonUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedLookupData();
        $this->createTestUsers();
    }

    protected function seedLookupData(): void
    {
        TicketStatus::firstOrCreate(['name' => 'aberta'], ['description' => 'Aberta']);
        TicketStatus::firstOrCreate(['name' => 'em curso'], ['description' => 'Em curso']);
        TicketStatus::firstOrCreate(['name' => 'fechada'], ['description' => 'Fechada']);
        TicketStatus::firstOrCreate(['name' => 'cancelada'], ['description' => 'Cancelada']);
        TicketStatus::firstOrCreate(['name' => 'pendente orçamento'], ['description' => 'Pendente']);
        TicketStatus::firstOrCreate(['name' => 'recusada'], ['description' => 'Recusada']);
    }

    protected function createTestUsers(): void
    {
        $adminProfile = UserProfile::firstOrCreate(['name' => User::ROLE_ADMIN]);
        $techProfile = UserProfile::firstOrCreate(['name' => User::ROLE_TECHNICIAN]);
        $userProfile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);

        $this->admin = User::factory()->create(['profile_id' => $adminProfile->id, 'api_token' => 'admin-test-token-perf']);
        $this->technician = User::factory()->create(['profile_id' => $techProfile->id, 'api_token' => 'tech-test-token-perf']);
        $this->commonUser = User::factory()->create(['profile_id' => $userProfile->id, 'api_token' => 'user-test-token-perf']);
    }

    protected function asAdmin(): static
    {
        return $this->withHeader('X-Auth-Token', $this->admin->api_token)
            ->withHeader('Accept', 'application/json');
    }

    protected function asTechnician(): static
    {
        return $this->withHeader('X-Auth-Token', $this->technician->api_token)
            ->withHeader('Accept', 'application/json');
    }

    protected function asUser(): static
    {
        return $this->withHeader('X-Auth-Token', $this->commonUser->api_token)
            ->withHeader('Accept', 'application/json');
    }

    protected function asUserWithToken(User $user): static
    {
        return $this->withHeader('X-Auth-Token', $user->api_token)
            ->withHeader('Accept', 'application/json');
    }

    protected function createUserWithRole(string $role): User
    {
        $profile = UserProfile::firstOrCreate(['name' => $role]);

        return User::factory()->create([
            'profile_id' => $profile->id,
            'api_token' => uniqid('perf-token-', true),
        ]);
    }

    protected function seedRooms(int $count): array
    {
        $rooms = [];
        for ($i = 0; $i < $count; $i++) {
            $rooms[] = Room::create([
                'name' => 'Performance Test Room '.$i,
                'location' => 'Location '.$i,
                'active' => true,
            ]);
        }

        return $rooms;
    }

    protected function seedEquipmentCategories(int $count): array
    {
        $categories = [];
        for ($i = 0; $i < $count; $i++) {
            $categories[] = EquipmentCategory::create([
                'name' => 'Perf Category '.$i,
                'active' => true,
            ]);
        }

        return $categories;
    }

    protected function seedEquipments(int $count, ?int $roomId = null, ?int $categoryId = null): array
    {
        $equipments = [];
        $roomIds = $roomId ? [$roomId] : array_column(Room::all()->toArray(), 'id');
        $categoryIds = $categoryId ? [$categoryId] : array_column(EquipmentCategory::all()->toArray(), 'id');

        if (empty($roomIds)) {
            $room = Room::create(['name' => 'Auto Room', 'active' => true]);
            $roomIds = [$room->id];
        }
        if (empty($categoryIds)) {
            $cat = EquipmentCategory::create(['name' => 'Auto Cat', 'active' => true]);
            $categoryIds = [$cat->id];
        }

        for ($i = 0; $i < $count; $i++) {
            $equipments[] = Equipment::create([
                'name' => 'Equipment '.$i,
                'serial' => 'PERF-'.str_pad((string) $i, 5, '0', STR_PAD_LEFT),
                'room_id' => $roomIds[array_rand($roomIds)],
                'category_id' => $categoryIds[array_rand($categoryIds)],
                'active' => true,
            ]);
        }

        return $equipments;
    }

    protected function seedTickets(int $count, array $overrides = []): array
    {
        $statusIds = TicketStatus::pluck('id')->toArray();
        $userIds = [$this->admin->id, $this->technician->id, $this->commonUser->id];
        $equipmentIds = Equipment::pluck('id')->toArray();
        $roomIds = Room::pluck('id')->toArray();
        $priorities = [Ticket::PRIORITY_LOW, Ticket::PRIORITY_MEDIUM, Ticket::PRIORITY_HIGH];

        $tickets = [];

        for ($i = 0; $i < $count; $i++) {
            $tickets[] = Ticket::create(array_merge([
                'title' => 'Performance Test Ticket '.$i,
                'description' => 'Test description for performance benchmark '.$i,
                'priority' => $priorities[array_rand($priorities)],
                'user_id' => $userIds[array_rand($userIds)],
                'assigned_to' => $userIds[array_rand($userIds)],
                'equipment_id' => ! empty($equipmentIds) ? $equipmentIds[array_rand($equipmentIds)] : null,
                'room_id' => ! empty($roomIds) ? $roomIds[array_rand($roomIds)] : null,
                'status_id' => $statusIds[array_rand($statusIds)],
                'opened_at' => now()->subDays(rand(0, 30)),
                'minutes_spent' => rand(15, 240),
                'cost' => round(rand(10, 500) / 10, 2),
            ], $overrides));
        }

        return $tickets;
    }

    protected function measureTime(callable $callback): float
    {
        $start = microtime(true);
        $callback();
        $end = microtime(true);

        return ($end - $start) * 1000;
    }

    protected function measureMemory(callable $callback): array
    {
        gc_collect_cycles();
        $before = memory_get_usage(true);
        $callback();
        $after = memory_get_usage(true);
        $peak = memory_get_peak_usage(true);

        return [
            'before' => $before,
            'after' => $after,
            'delta' => $after - $before,
            'peak' => $peak,
        ];
    }

    protected function getQueryCount(): int
    {
        return count(DB::getQueryLog());
    }

    protected function startQueryLog(): void
    {
        DB::flushQueryLog();
        DB::enableQueryLog();
    }

    protected function stopQueryLog(): array
    {
        $log = DB::getQueryLog();
        DB::disableQueryLog();

        return $log;
    }

    protected function assertQueryCountBelow(int $max, ?string $message = null): void
    {
        $count = $this->getQueryCount();
        $this->assertLessThanOrEqual(
            $max,
            $count,
            $message ?? "Expected query count below {$max}, got {$count}"
        );
    }
}
