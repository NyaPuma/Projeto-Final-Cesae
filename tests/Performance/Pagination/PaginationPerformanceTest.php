<?php

namespace Tests\Performance\Pagination;

use Tests\Performance\PerformanceTestCase;

class PaginationPerformanceTest extends PerformanceTestCase
{
    public function test_ticket_pagination_100_items(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(100);

        $this->asAdmin();
        $this->startQueryLog();

        $time = $this->measureTime(function () {
            $this->getJson('/api/tickets?page=1')->assertOk();
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(300, $time,
            "Pagination with 100 items took {$time}ms");
        $this->assertLessThanOrEqual(10, count($queries));
    }

    public function test_ticket_pagination_1000_items(): void
    {
        $this->seedRooms(10);
        $this->seedEquipments(20);
        $this->seedTickets(1000);

        $this->asAdmin();
        $this->startQueryLog();

        $time = $this->measureTime(function () {
            $this->getJson('/api/tickets?page=1')->assertOk();
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(500, $time,
            "Pagination with 1000 items took {$time}ms");
        $this->assertLessThanOrEqual(10, count($queries));
    }

    public function test_ticket_pagination_10000_items(): void
    {
        $this->seedRooms(20);
        $this->seedEquipments(40);
        $this->seedTickets(10000);

        $this->asAdmin();
        $this->startQueryLog();

        $time = $this->measureTime(function () {
            $this->getJson('/api/tickets?page=1')->assertOk();
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(1000, $time,
            "Pagination with 10000 items took {$time}ms");
        $this->assertLessThanOrEqual(10, count($queries));
    }

    public function test_search_pagination_1000_items(): void
    {
        $this->seedRooms(10);
        $this->seedEquipments(20);
        $this->seedTickets(1000);

        $this->asAdmin();

        $times = [];
        for ($page = 1; $page <= 5; $page++) {
            $times[] = $this->measureTime(function () use ($page) {
                $this->getJson("/tickets/search?page={$page}")->assertOk();
            });
        }

        $avg = array_sum($times) / count($times);
        $max = max($times);

        $this->assertLessThanOrEqual(500, $avg,
            "Average search pagination: {$avg}ms");
        $this->assertLessThanOrEqual(700, $max,
            "Max search pagination: {$max}ms");
    }

    public function test_pagination_deep_page_performance(): void
    {
        $this->seedRooms(10);
        $this->seedEquipments(20);
        $this->seedTickets(1000);

        $this->asAdmin();

        $pages = [1, 10, 33, 50, 67];
        $times = [];

        foreach ($pages as $page) {
            $times[$page] = $this->measureTime(function () use ($page) {
                $this->getJson("/api/tickets?page={$page}")->assertOk();
            });
        }

        $max = max($times);
        $this->assertLessThanOrEqual(700, $max,
            "Deepest page (max page queried) took {$max}ms");
    }

    public function test_pagination_response_structure(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(30);

        $this->asAdmin();

        $response = $this->getJson('/api/tickets?page=1')->assertOk();

        $data = $response->json('tickets');

        $this->assertArrayHasKey('data', $data);
        $this->assertArrayHasKey('current_page', $data);
        $this->assertArrayHasKey('per_page', $data);
        $this->assertArrayHasKey('total', $data);
        $this->assertLessThanOrEqual(15, count($data['data']),
            'Per page should be 15');
    }

    public function test_admin_users_pagination(): void
    {
        $this->seedRooms(2);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/admin/users?page=1')->assertOk();
        });

        $this->assertLessThanOrEqual(300, $time,
            "Admin users pagination took {$time}ms");
    }

    public function test_equipment_pagination(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(100);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/admin/equipment?page=1')->assertOk();
        });

        $this->assertLessThanOrEqual(300, $time,
            "Equipment pagination took {$time}ms");
    }

    public function test_audit_pagination(): void
    {
        $this->seedRooms(2);
        $this->seedEquipments(3);
        $this->seedTickets(50);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/admin/audits?page=1')->assertOk();
        });

        $this->assertLessThanOrEqual(300, $time,
            "Audit pagination took {$time}ms");
    }
}
