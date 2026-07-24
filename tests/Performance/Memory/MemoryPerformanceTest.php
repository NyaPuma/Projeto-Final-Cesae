<?php

namespace Tests\Performance\Memory;

use Tests\Performance\PerformanceTestCase;

class MemoryPerformanceTest extends PerformanceTestCase
{
    private const MAX_PEAK_MB = 128;

    public function test_ticket_listing_memory_usage(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(500);

        $this->asAdmin();

        gc_collect_cycles();
        $before = memory_get_usage();

        $this->getJson('/api/tickets');

        gc_collect_cycles();
        $after = memory_get_usage();
        $peak = memory_get_peak_usage();

        $this->assertLessThanOrEqual(self::MAX_PEAK_MB * 1024 * 1024, $peak,
            "Peak memory for ticket listing: ".round($peak / 1024 / 1024, 2).'MB');
    }

    public function test_analytics_memory_usage(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(500);

        $this->asAdmin();

        gc_collect_cycles();

        $memory = $this->measureMemory(function () {
            $this->getJson('/analytics');
        });

        $this->assertLessThanOrEqual(self::MAX_PEAK_MB * 1024 * 1024, $memory['peak'],
            "Analytics peak memory: ".round($memory['peak'] / 1024 / 1024, 2).'MB');
    }

    public function test_search_memory_usage(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(500);

        $this->asAdmin();

        gc_collect_cycles();

        $memory = $this->measureMemory(function () {
            $this->getJson('/tickets/search?q=Performance');
        });

        $this->assertLessThanOrEqual(self::MAX_PEAK_MB * 1024 * 1024, $memory['peak'],
            "Search peak memory: ".round($memory['peak'] / 1024 / 1024, 2).'MB');
    }

    public function test_memory_stability_under_repeated_requests(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(100);

        $this->asAdmin();

        gc_collect_cycles();
        $initialMemory = memory_get_usage(true);

        for ($i = 0; $i < 50; $i++) {
            $this->getJson('/api/tickets');
        }

        gc_collect_cycles();
        $finalMemory = memory_get_usage(true);
        $growth = $finalMemory - $initialMemory;

        $this->assertLessThanOrEqual(10 * 1024 * 1024, $growth,
            "Memory grew by ".round($growth / 1024 / 1024, 2).'MB after 50 requests (possible leak)');
    }

    public function test_memory_stability_analytics_repeated(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(50);

        $this->asAdmin();

        gc_collect_cycles();
        $initialMemory = memory_get_usage(true);

        for ($i = 0; $i < 20; $i++) {
            $this->getJson('/analytics');
        }

        gc_collect_cycles();
        $finalMemory = memory_get_usage(true);
        $growth = $finalMemory - $initialMemory;

        $this->assertLessThanOrEqual(10 * 1024 * 1024, $growth,
            "Analytics memory grew by ".round($growth / 1024 / 1024, 2).'MB after 20 calls');
    }

    public function test_memory_during_bulk_ticket_creation(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);

        $this->asUser();

        gc_collect_cycles();
        $before = memory_get_usage();

        for ($i = 0; $i < 50; $i++) {
            $this->postJson('/api/tickets', [
                'title' => 'Bulk Test Ticket '.$i,
                'description' => 'Creating ticket number '.$i.' for memory testing',
                'priority' => 'média',
            ]);
        }

        gc_collect_cycles();
        $after = memory_get_usage();
        $growth = $after - $before;

        $this->assertLessThanOrEqual(20 * 1024 * 1024, $growth,
            "Bulk creation memory grew by ".round($growth / 1024 / 1024, 2).'MB');
    }

    public function test_peak_memory_across_endpoints(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(200);

        $this->asAdmin();

        $endpoints = [
            '/api/tickets',
            '/analytics',
            '/analytics/charts',
            '/admin/users',
            '/admin/equipment',
            '/admin/audits',
            '/notifications',
        ];

        $peakMemories = [];

        foreach ($endpoints as $endpoint) {
            gc_collect_cycles();
            $this->getJson($endpoint);
            $peakMemories[$endpoint] = memory_get_peak_usage(true);
        }

        $maxPeak = max($peakMemories);

        $this->assertLessThanOrEqual(self::MAX_PEAK_MB * 1024 * 1024, $maxPeak,
            "Highest peak memory across all endpoints: ".round($maxPeak / 1024 / 1024, 2).'MB');
    }
}
