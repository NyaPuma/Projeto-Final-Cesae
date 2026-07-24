<?php

namespace Tests\Performance\Scalability;

use Tests\Performance\PerformanceTestCase;

class ScalabilityPerformanceTest extends PerformanceTestCase
{
    public function test_concurrent_ticket_creation_20_requests(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);

        $this->asUser();

        $totalTime = $this->measureTime(function () {
            for ($i = 0; $i < 20; $i++) {
                $this->postJson('/api/tickets', [
                    'title' => 'Concurrent Test Ticket '.$i,
                    'description' => 'Scalability test '.$i,
                    'priority' => 'média',
                ])->assertStatus(201);
            }
        });

        $avgTime = $totalTime / 20;

        $this->assertLessThanOrEqual(300, $avgTime,
            "Average ticket creation: {$avgTime}ms across 20 sequential requests");
        $this->assertLessThanOrEqual(5000, $totalTime,
            "Total 20 ticket creations: {$totalTime}ms");
    }

    public function test_rapid_ticket_read_50_requests(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $tickets = $this->seedTickets(10);

        $this->asAdmin();

        $totalTime = $this->measureTime(function () use ($tickets) {
            for ($i = 0; $i < 50; $i++) {
                $ticketId = $tickets[array_rand($tickets)]->id;
                $this->getJson('/api/tickets/'.$ticketId)->assertOk();
            }
        });

        $avgTime = $totalTime / 50;

        $this->assertLessThanOrEqual(200, $avgTime,
            "Average read: {$avgTime}ms");
    }

    public function test_rapid_search_30_requests(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(200);

        $this->asAdmin();

        $totalTime = $this->measureTime(function () {
            $terms = ['Performance', 'Test', 'Ticket', 'Equipment', 'Room'];
            for ($i = 0; $i < 30; $i++) {
                $term = $terms[array_rand($terms)];
                $this->getJson('/tickets/search?q='.$term)->assertOk();
            }
        });

        $avgTime = $totalTime / 30;

        $this->assertLessThanOrEqual(500, $avgTime,
            "Average search: {$avgTime}ms");
    }

    public function test_mixed_workload_simulation(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(100, ['user_id' => $this->commonUser->id]);

        $operations = 0;
        $totalTime = $this->measureTime(function () use (&$operations) {
            $this->asAdmin();
            for ($i = 0; $i < 10; $i++) {
                $this->getJson('/api/tickets');
                $operations++;
            }

            for ($i = 0; $i < 5; $i++) {
                $this->getJson('/tickets/search?q=Test');
                $operations++;
            }

            $this->asUser();
            for ($i = 0; $i < 5; $i++) {
                $this->postJson('/api/tickets', [
                    'title' => 'Mixed Workload Ticket '.$i,
                    'description' => 'Mixed workload test',
                    'priority' => 'baixa',
                ]);
                $operations++;
            }

            $this->asAdmin();
            for ($i = 0; $i < 3; $i++) {
                $this->getJson('/analytics');
                $operations++;
            }

            for ($i = 0; $i < 3; $i++) {
                $this->getJson('/notifications');
                $operations++;
            }
        });

        $avgTime = $totalTime / $operations;

        $this->assertLessThanOrEqual(500, $avgTime,
            "Mixed workload average: {$avgTime}ms across {$operations} operations");
        $this->assertLessThanOrEqual(15000, $totalTime,
            "Total mixed workload: {$totalTime}ms");
    }

    public function test_pagination_through_all_pages(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(200);

        $this->asAdmin();

        $totalTime = $this->measureTime(function () {
            $page = 1;
            do {
                $response = $this->getJson("/api/tickets?page={$page}");
                $data = $response->json('tickets');
                $page++;
            } while ($page <= ($data['last_page'] ?? 1));
        });

        $this->assertLessThanOrEqual(5000, $totalTime,
            "Paginating through all pages took {$totalTime}ms");
    }

    public function test_write_heavy_workload(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $tickets = $this->seedTickets(10, ['user_id' => $this->commonUser->id]);

        $this->asUser();

        $totalTime = $this->measureTime(function () use ($tickets) {
            for ($i = 0; $i < 30; $i++) {
                $ticket = $tickets[array_rand($tickets)];
                $this->postJson('/tickets/'.$ticket->id.'/comments', [
                    'comment' => 'Scalability comment '.$i,
                ])->assertStatus(201);
            }
        });

        $avgTime = $totalTime / 30;

        $this->assertLessThanOrEqual(200, $avgTime,
            "Comment creation average: {$avgTime}ms");
    }

    public function test_read_heavy_workload(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(200);

        $this->asAdmin();

        $totalTime = $this->measureTime(function () {
            for ($i = 0; $i < 100; $i++) {
                $this->getJson('/api/tickets?page='.($i % 10 + 1));
            }
        });

        $avgTime = $totalTime / 100;

        $this->assertLessThanOrEqual(300, $avgTime,
            "Read-heavy average: {$avgTime}ms per request");
    }

    public function test_admin_crud_operations_scalability(): void
    {
        $this->seedRooms(3);

        $this->asAdmin();

        $totalTime = $this->measureTime(function () {
            for ($i = 0; $i < 10; $i++) {
                $this->postJson('/admin/users/register', [
                    'name' => 'Scale User '.$i,
                    'email' => 'scale-user-'.uniqid().'@test.com',
                    'password' => 'Password123!',
                    'password_confirmation' => 'Password123!',
                ]);
            }

            for ($i = 0; $i < 5; $i++) {
                $this->getJson('/admin/users');
            }

            for ($i = 0; $i < 10; $i++) {
                $this->postJson('/api/rooms', [
                    'name' => 'Scale Room '.$i,
                    'location' => 'Scale Location '.$i,
                ]);
            }
        });

        $this->assertLessThanOrEqual(10000, $totalTime,
            "Admin CRUD scalability: {$totalTime}ms");
    }
}
