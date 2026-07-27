<?php

namespace Tests\Performance\Search;

use Tests\Performance\PerformanceTestCase;

class SearchPerformanceTest extends PerformanceTestCase
{
    private const MAX_SEARCH_MS = 500;

    public function test_simple_like_search_response_time(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(200);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/tickets/search?q=Performance')->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_SEARCH_MS, $time,
            "Simple LIKE search took {$time}ms");
    }

    public function test_search_with_priority_filter(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(200);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/tickets/search?q=Performance&priority=alta')->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_SEARCH_MS, $time,
            "Search with priority filter took {$time}ms");
    }

    public function test_search_with_status_filter(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(200);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/tickets/search?status=aberta')->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_SEARCH_MS, $time,
            "Search with status filter took {$time}ms");
    }

    public function test_search_with_date_range_filter(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(200);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/tickets/search?date_from='.now()->subDays(7)->format('Y-m-d').'&date_to='.now()->format('Y-m-d'))->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_SEARCH_MS, $time,
            "Search with date range took {$time}ms");
    }

    public function test_search_with_multiple_filters(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(500);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/tickets/search?q=Performance&priority=alta&status=aberta&date_from='
                .now()->subDays(30)->format('Y-m-d').'&date_to='.now()->format('Y-m-d'))->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_SEARCH_MS, $time,
            "Search with multiple filters took {$time}ms");
    }

    public function test_search_with_1000_records(): void
    {
        $this->seedRooms(10);
        $this->seedEquipments(20);
        $this->seedTickets(1000);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/tickets/search?q=Performance Test')->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_SEARCH_MS, $time,
            "Search across 1000 records took {$time}ms");
    }

    public function test_search_with_empty_results(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(100);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/tickets/search?q=ZZZNONEXISTENTZZZ')->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_SEARCH_MS, $time,
            "Search with no results took {$time}ms");
    }

    public function test_search_sorting_performance(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(500);

        $this->asAdmin();
        $this->startQueryLog();

        $time = $this->measureTime(function () {
            $this->getJson('/tickets/search?q=Performance')->assertOk();
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(self::MAX_SEARCH_MS, $time);
        $this->assertLessThanOrEqual(15, count($queries));
    }

    public function test_admin_user_search_performance(): void
    {
        $this->seedRooms(2);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/admin/users?q=Performance')->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_SEARCH_MS, $time,
            "User search took {$time}ms");
    }

    public function test_equipment_search_performance(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(100);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/equipments?q=Equipment')->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_SEARCH_MS, $time,
            "Equipment search took {$time}ms");
    }

    public function test_search_pagination_performance(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(500);

        $this->asAdmin();

        $times = [];
        for ($page = 1; $page <= 5; $page++) {
            $times[] = $this->measureTime(function () use ($page) {
                $this->getJson("/tickets/search?q=Performance&page={$page}")->assertOk();
            });
        }

        $avg = array_sum($times) / count($times);
        $this->assertLessThanOrEqual(self::MAX_SEARCH_MS, $avg,
            "Average paginated search: {$avg}ms");
    }
}
