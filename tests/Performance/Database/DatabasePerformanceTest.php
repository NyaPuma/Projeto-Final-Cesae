<?php

namespace Tests\Performance\Database;

use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Tests\Performance\PerformanceTestCase;

class DatabasePerformanceTest extends PerformanceTestCase
{
    public function test_ticket_listing_n_plus_one_detection(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(30);

        $this->asAdmin();
        $this->startQueryLog();

        $this->getJson('/api/tickets');

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(10, count($queries),
            "N+1 detected: Ticket listing used ".count($queries).' queries');
    }

    public function test_ticket_detail_n_plus_one_detection(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $tickets = $this->seedTickets(1);

        $this->asAdmin();
        $this->startQueryLog();

        $this->getJson('/tickets/'.$tickets[0]->id);

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(15, count($queries),
            "N+1 detected: Ticket detail used ".count($queries).' queries');
    }

    public function test_ticket_search_n_plus_one_detection(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(100);

        $this->asAdmin();
        $this->startQueryLog();

        $this->getJson('/tickets/search?q=Performance');

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(15, count($queries),
            "N+1 detected: Search used ".count($queries).' queries');
    }

    public function test_ticket_search_multiple_filters(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(200);

        $this->asAdmin();
        $this->startQueryLog();

        $this->getJson('/tickets/search?q=Performance&priority=alta&status=aberta');

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(15, count($queries),
            "Filtered search used ".count($queries).' queries');
    }

    public function test_admin_users_listing_queries(): void
    {
        $this->seedRooms(2);

        $this->asAdmin();
        $this->startQueryLog();

        $this->getJson('/admin/users');

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(8, count($queries),
            "Admin users listing used ".count($queries).' queries');
    }

    public function test_equipments_listing_queries(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(20);

        $this->asAdmin();
        $this->startQueryLog();

        $this->getJson('/admin/equipment');

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(8, count($queries),
            "Equipment listing used ".count($queries).' queries');
    }

    public function test_ticket_listing_with_100_records(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(100);

        $this->asAdmin();
        $this->startQueryLog();

        $time = $this->measureTime(function () {
            $this->getJson('/api/tickets');
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(10, count($queries));
        $this->assertLessThanOrEqual(300, $time);
    }

    public function test_ticket_listing_with_1000_records(): void
    {
        $this->seedRooms(10);
        $this->seedEquipments(20);
        $this->seedTickets(1000);

        $this->asAdmin();
        $this->startQueryLog();

        $time = $this->measureTime(function () {
            $this->getJson('/api/tickets');
        });

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(10, count($queries));
        $this->assertLessThanOrEqual(500, $time);
    }

    public function test_ticket_search_pagination_performance(): void
    {
        $this->seedRooms(10);
        $this->seedEquipments(20);
        $this->seedTickets(500);

        $this->asAdmin();

        $times = [];
        for ($page = 1; $page <= 5; $page++) {
            $times[] = $this->measureTime(function () use ($page) {
                $this->getJson("/tickets/search?page={$page}");
            });
        }

        $avg = array_sum($times) / count($times);
        $this->assertLessThanOrEqual(500, $avg,
            "Average pagination query: {$avg}ms across 5 pages");
    }

    public function test_audits_listing_queries(): void
    {
        $this->seedRooms(2);
        $this->seedEquipments(3);
        $this->seedTickets(30);

        $this->asAdmin();
        $this->startQueryLog();

        $this->getJson('/admin/audits');

        $queries = $this->stopQueryLog();

        $this->assertLessThanOrEqual(8, count($queries),
            "Audits listing used ".count($queries).' queries');
    }

    public function test_ticket_detail_eager_loading_relationships(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $tickets = $this->seedTickets(1);

        $this->asAdmin();
        $this->startQueryLog();

        $response = $this->getJson('/tickets/'.$tickets[0]->id);

        $queries = $this->stopQueryLog();
        $response->assertOk();

        $this->assertLessThanOrEqual(10, count($queries),
            'Ticket detail should eager load all relationships. Used '.count($queries).' queries');
    }

    public function test_query_count_stability_with_increasing_data(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);

        $this->asAdmin();

        $counts = [];
        foreach ([10, 50, 100, 500] as $ticketCount) {
            Ticket::query()->delete();
            $this->seedTickets($ticketCount);

            $this->startQueryLog();
            $this->getJson('/api/tickets');
            $log = $this->stopQueryLog();

            $counts[$ticketCount] = count($log);
        }

        $firstCount = reset($counts);
        $lastCount = end($counts);

        $this->assertLessThanOrEqual(3, abs($firstCount - $lastCount),
            'Query count should remain stable regardless of data volume. '
            .'10 records: '.$counts[10].', 500 records: '.$counts[500]);
    }
}
