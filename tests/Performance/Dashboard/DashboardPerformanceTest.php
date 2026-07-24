<?php

namespace Tests\Performance\Dashboard;

use Tests\Performance\PerformanceTestCase;

class DashboardPerformanceTest extends PerformanceTestCase
{
    private const MAX_DASHBOARD_MS = 700;

    public function test_analytics_stats_with_small_dataset(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(20);

        $this->asAdmin();
        $this->startQueryLog();

        $time = $this->measureTime(function () {
            $this->getJson('/analytics')->assertOk();
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(self::MAX_DASHBOARD_MS, $time,
            "Analytics stats with 20 tickets took {$time}ms");
        $this->assertLessThanOrEqual(20, count($queries));
    }

    public function test_analytics_stats_with_large_dataset(): void
    {
        $this->seedRooms(10);
        $this->seedEquipments(20);
        $this->seedTickets(1000);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/analytics')->assertOk();
        });

        $this->assertLessThanOrEqual(2000, $time,
            "Analytics stats with 1000 tickets took {$time}ms");
    }

    public function test_analytics_charts_with_large_dataset(): void
    {
        $this->seedRooms(10);
        $this->seedEquipments(20);
        $this->seedTickets(1000);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/analytics/charts')->assertOk();
        });

        $this->assertLessThanOrEqual(2000, $time,
            "Analytics charts with 1000 tickets took {$time}ms");
    }

    public function test_dashboard_loads_multiple_endpoints_sequentially(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(200);

        $this->asAdmin();

        $totalTime = $this->measureTime(function () {
            $this->getJson('/analytics')->assertOk();
            $this->getJson('/analytics/charts')->assertOk();
            $this->getJson('/notifications')->assertOk();
            $this->getJson('/technician/tickets/open')->assertOk();
        });

        $this->assertLessThanOrEqual(3000, $totalTime,
            "Full dashboard load (4 endpoints) took {$totalTime}ms");
    }

    public function test_analytics_stats_repeated_requests_stability(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(50);

        $this->asAdmin();

        $times = [];
        for ($i = 0; $i < 10; $i++) {
            $times[] = $this->measureTime(function () {
                $this->getJson('/analytics')->assertOk();
            });
        }

        $avg = array_sum($times) / count($times);
        $max = max($times);

        $this->assertLessThanOrEqual(self::MAX_DASHBOARD_MS, $avg,
            "Average analytics stats response: {$avg}ms");
        $this->assertLessThanOrEqual(self::MAX_DASHBOARD_MS * 2, $max,
            "Max analytics stats response: {$max}ms");
    }
}
