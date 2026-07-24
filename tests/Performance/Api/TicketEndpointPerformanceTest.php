<?php

namespace Tests\Performance\Api;

use Tests\Performance\PerformanceTestCase;

class TicketEndpointPerformanceTest extends PerformanceTestCase
{
    private const MAX_RESPONSE_MS = 300;

    public function test_ticket_index_response_time(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(50);

        $this->asAdmin();
        $this->startQueryLog();

        $time = $this->measureTime(function () {
            $this->getJson('/api/tickets')->assertOk();
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(self::MAX_RESPONSE_MS, $time,
            "GET /api/tickets took {$time}ms, exceeds ".self::MAX_RESPONSE_MS.'ms');
        $this->assertLessThanOrEqual(10, count($queries),
            'Ticket index should use 10 or fewer queries, used '.count($queries));
    }

    public function test_ticket_index_with_500_records(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(500);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/api/tickets')->assertOk();
        });

        $this->assertLessThanOrEqual(500, $time,
            "GET /api/tickets with 500 records took {$time}ms");
    }

    public function test_ticket_index_with_1000_records(): void
    {
        $this->seedRooms(10);
        $this->seedEquipments(20);
        $this->seedTickets(1000);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/api/tickets')->assertOk();
        });

        $this->assertLessThanOrEqual(500, $time,
            "GET /api/tickets with 1000 records took {$time}ms");
    }

    public function test_ticket_show_response_time(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $tickets = $this->seedTickets(1);

        $this->asAdmin();
        $this->startQueryLog();

        $time = $this->measureTime(function () use ($tickets) {
            $this->getJson('/api/tickets/'.$tickets[0]->id)->assertOk();
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(self::MAX_RESPONSE_MS, $time,
            "GET /api/tickets/{id} took {$time}ms");
        $this->assertLessThanOrEqual(10, count($queries),
            'Ticket detail should use 10 or fewer queries');
    }

    public function test_ticket_store_response_time(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);

        $this->asUser();
        $this->startQueryLog();

        $time = $this->measureTime(function () {
            $this->postJson('/api/tickets', [
                'title' => 'Performance Test Ticket',
                'description' => 'This is a performance test ticket for benchmarking',
                'priority' => 'média',
            ])->assertStatus(201);
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(self::MAX_RESPONSE_MS, $time,
            "POST /api/tickets took {$time}ms");
    }

    public function test_ticket_search_response_time(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(200);

        $this->asAdmin();
        $this->startQueryLog();

        $time = $this->measureTime(function () {
            $this->getJson('/tickets/search?q=Performance&priority=alta')->assertOk();
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(500, $time,
            "GET /tickets/search took {$time}ms");
        $this->assertLessThanOrEqual(15, count($queries),
            'Search should use 15 or fewer queries');
    }

    public function test_ticket_search_with_1000_records(): void
    {
        $this->seedRooms(10);
        $this->seedEquipments(20);
        $this->seedTickets(1000);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/tickets/search?q=Performance')->assertOk();
        });

        $this->assertLessThanOrEqual(500, $time,
            "Search with 1000 records took {$time}ms");
    }

    public function test_rooms_index_response_time(): void
    {
        $this->seedRooms(50);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/api/rooms')->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_RESPONSE_MS, $time,
            "GET /api/rooms took {$time}ms");
    }

    public function test_equipments_index_response_time(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(50);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/admin/equipment')->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_RESPONSE_MS, $time,
            "GET /admin/equipment took {$time}ms");
    }

    public function test_notifications_index_response_time(): void
    {
        $this->seedRooms(2);
        $this->seedEquipments(3);
        $this->seedTickets(10);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/notifications')->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_RESPONSE_MS, $time,
            "GET /notifications took {$time}ms");
    }

    public function test_users_index_response_time(): void
    {
        $this->seedRooms(2);
        $this->seedEquipments(3);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/admin/users')->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_RESPONSE_MS, $time,
            "GET /admin/users took {$time}ms");
    }

    public function test_ticket_add_comment_response_time(): void
    {
        $this->seedRooms(2);
        $this->seedEquipments(3);
        $tickets = $this->seedTickets(1, ['user_id' => $this->commonUser->id]);

        $this->asUser();
        $this->startQueryLog();

        $time = $this->measureTime(function () use ($tickets) {
            $this->postJson('/tickets/'.$tickets[0]->id.'/comments', [
                'comment' => 'Performance test comment',
            ])->assertStatus(201);
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(self::MAX_RESPONSE_MS, $time,
            "POST /tickets/{id}/comments took {$time}ms");
    }

    public function test_calendar_events_response_time(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(100, ['scheduled_at' => now()->addDays(1), 'scheduled' => true]);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/calendar/events')->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_RESPONSE_MS, $time,
            "GET /calendar/events took {$time}ms");
    }

    public function test_analytics_stats_response_time(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(200);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/analytics')->assertOk();
        });

        $this->assertLessThanOrEqual(700, $time,
            "GET /analytics took {$time}ms, exceeds 700ms for dashboard");
    }

    public function test_analytics_charts_response_time(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(200);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/analytics/charts')->assertOk();
        });

        $this->assertLessThanOrEqual(700, $time,
            "GET /analytics/charts took {$time}ms");
    }

    public function test_open_tickets_response_time(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $openStatusId = \App\Models\TicketStatus::where('name', 'aberta')->value('id');
        $this->seedTickets(100, ['status_id' => $openStatusId]);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/technician/tickets/open')->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_RESPONSE_MS, $time,
            "GET /technician/tickets/open took {$time}ms");
    }

    public function test_admin_audits_response_time(): void
    {
        $this->seedRooms(2);
        $this->seedEquipments(3);
        $this->seedTickets(20);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/admin/audits')->assertOk();
        });

        $this->assertLessThanOrEqual(self::MAX_RESPONSE_MS, $time,
            "GET /admin/audits took {$time}ms");
    }
}
