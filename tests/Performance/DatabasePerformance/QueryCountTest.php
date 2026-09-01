<?php

namespace Tests\Performance\DatabasePerformance;

use App\Enums\UserRoleEnum;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class QueryCountTest extends TestCase
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
    public function it_limits_queries_for_ticket_index(): void
    {
        User::factory()->count(10)->create();
        Ticket::factory()->count(20)->create();

        DB::enableQueryLog();

        $this->getJson('/api/tickets');

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertLessThanOrEqual(5, $queryCount, "Ticket index should use <= 5 queries, got {$queryCount}");
    }

    #[Test]
    public function it_limits_queries_for_ticket_show(): void
    {
        $user = User::factory()->create();
        $ticket = Ticket::factory()->create(['user_id' => $user->id]);

        DB::enableQueryLog();

        $this->getJson("/api/tickets/{$ticket->id}");

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertLessThanOrEqual(3, $queryCount, "Ticket show should use <= 3 queries, got {$queryCount}");
    }

    #[Test]
    public function it_limits_queries_for_user_index(): void
    {
        User::factory()->count(20)->create();

        DB::enableQueryLog();

        $this->getJson('/api/admin/users');

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertLessThanOrEqual(3, $queryCount, "User index should use <= 3 queries, got {$queryCount}");
    }

    #[Test]
    public function it_limits_queries_for_dashboard(): void
    {
        User::factory()->count(10)->create();
        Ticket::factory()->count(20)->create();

        DB::enableQueryLog();

        $this->getJson('/api/dashboard');

        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertLessThanOrEqual(10, $queryCount, "Dashboard should use <= 10 queries, got {$queryCount}");
    }

    #[Test]
    public function it_measures_query_performance(): void
    {
        User::factory()->count(50)->create();
        Ticket::factory()->count(100)->create();

        DB::enableQueryLog();
        $startTime = microtime(true);

        $this->getJson('/api/tickets');

        $endTime = microtime(true);
        $executionTime = ($endTime - $startTime) * 1000; // Convert to milliseconds
        $queryCount = count(DB::getQueryLog());
        DB::disableQueryLog();

        $this->assertLessThan(500, $executionTime, "Request should complete in < 500ms, took {$executionTime}ms");
        $this->assertLessThanOrEqual(5, $queryCount, "Should use <= 5 queries, used {$queryCount}");
    }

    #[Test]
    public function it_detects_query_regression(): void
    {
        $baselineQueries = 5;
        $threshold = 2; // Allow 2x baseline

        User::factory()->count(10)->create();
        Ticket::factory()->count(20)->create();

        DB::enableQueryLog();

        $this->getJson('/api/tickets');

        $actualQueries = count(DB::getQueryLog());
        DB::disableQueryLog();

        $maxAllowed = $baselineQueries * $threshold;
        $this->assertLessThanOrEqual($maxAllowed, $actualQueries, "Query regression: used {$actualQueries} queries, max allowed {$maxAllowed}");
    }
}
