<?php

namespace Tests\Performance\MemoryPerformance;


use App\Enums\UserRoleEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MemoryUsageTest extends TestCase
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
    public function it_limits_memory_for_large_dataset(): void
    {
        User::factory()->count(100)->create();
        Ticket::factory()->count(500)->create();

        $initialMemory = memory_get_usage();

        $tickets = Ticket::with(['user', 'equipment', 'room'])->get();

        $finalMemory = memory_get_usage();
        $memoryIncrease = ($finalMemory - $initialMemory) / 1024 / 1024; // Convert to MB

        $this->assertLessThan(50, $memoryIncrease, "Memory increase should be < 50MB, was {$memoryIncrease}MB");
    }

    #[Test]
    public function it_limits_memory_for_chunked_operations(): void
    {
        User::factory()->count(100)->create();
        Ticket::factory()->count(1000)->create();

        $initialMemory = memory_get_usage();

        Ticket::chunk(100, function ($tickets) {
            foreach ($tickets as $ticket) {
                $ticket->load('user');
            }
        });

        $finalMemory = memory_get_usage();
        $memoryIncrease = ($finalMemory - $initialMemory) / 1024 / 1024;

        $this->assertLessThan(20, $memoryIncrease, "Chunked operations should use < 20MB, was {$memoryIncrease}MB");
    }

    #[Test]
    public function it_detects_memory_leaks_in_loops(): void
    {
        User::factory()->count(10)->create();

        $initialMemory = memory_get_usage();

        for ($i = 0; $i < 100; $i++) {
            $users = User::all();
            unset($users);
        }

        gc_collect_cycles();
        $finalMemory = memory_get_usage();
        $memoryIncrease = ($finalMemory - $initialMemory) / 1024 / 1024;

        $this->assertLessThan(10, $memoryIncrease, "Loop should not leak memory, increased by {$memoryIncrease}MB");
    }

    #[Test]
    public function it_measures_memory_efficiency_of_eager_loading(): void
    {
        User::factory()->count(50)->create();
        Ticket::factory()->count(200)->create(['user_id' => User::inRandomOrder()->first()->id]);

        // Test lazy loading
        gc_collect_cycles();
        $initialMemory = memory_get_usage();

        $tickets = Ticket::all();
        foreach ($tickets as $ticket) {
            $ticket->user;
        }

        $lazyMemory = memory_get_usage();
        gc_collect_cycles();

        // Test eager loading
        gc_collect_cycles();
        $initialMemory2 = memory_get_usage();

        $tickets = Ticket::with('user')->get();
        foreach ($tickets as $ticket) {
            $ticket->user;
        }

        $eagerMemory = memory_get_usage();
        gc_collect_cycles();

        $lazyIncrease = ($lazyMemory - $initialMemory) / 1024 / 1024;
        $eagerIncrease = ($eagerMemory - $initialMemory2) / 1024 / 1024;

        $this->assertLessThanOrEqual($lazyIncrease, $eagerIncrease, 'Eager loading should be more memory efficient');
    }

    #[Test]
    public function it_limits_peak_memory_usage(): void
    {
        User::factory()->count(100)->create();
        Ticket::factory()->count(500)->create();

        $initialPeak = memory_get_peak_usage();

        Ticket::with(['user', 'equipment', 'room', 'comments', 'attachments'])->get();

        $finalPeak = memory_get_peak_usage();
        $peakIncrease = ($finalPeak - $initialPeak) / 1024 / 1024;

        $this->assertLessThan(100, $peakIncrease, "Peak memory should increase < 100MB, was {$peakIncrease}MB");
    }
}
