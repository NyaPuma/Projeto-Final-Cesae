<?php

namespace Tests\Performance\Reports;

use App\Models\Ticket;
use Illuminate\Support\Facades\Storage;
use Tests\Performance\PerformanceTestCase;

class ReportPerformanceTest extends PerformanceTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    public function test_csv_export_small_dataset(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(50);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/analytics/export/csv')->assertOk();
        });

        $this->assertLessThanOrEqual(500, $time,
            "CSV export (50 tickets) took {$time}ms");
    }

    public function test_csv_export_medium_dataset(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(500);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/analytics/export/csv')->assertOk();
        });

        $this->assertLessThanOrEqual(1000, $time,
            "CSV export (500 tickets) took {$time}ms");
    }

    public function test_csv_export_large_dataset(): void
    {
        $this->seedRooms(10);
        $this->seedEquipments(20);
        $this->seedTickets(1000);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/analytics/export/csv')->assertOk();
        });

        $this->assertLessThanOrEqual(2000, $time,
            "CSV export (1000 tickets) took {$time}ms");
    }

    public function test_pdf_export_small_dataset(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(20);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/analytics/export/pdf')->assertOk();
        });

        $this->assertLessThanOrEqual(5000, $time,
            "PDF export (20 tickets) took {$time}ms");
    }

    public function test_pdf_export_medium_dataset(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(100);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/analytics/export/pdf')->assertOk();
        });

        $this->assertLessThanOrEqual(5000, $time,
            "PDF export (100 tickets) took {$time}ms");
    }

    public function test_excel_export_small_dataset(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(50);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/analytics/export/excel')->assertOk();
        });

        $this->assertLessThanOrEqual(3000, $time,
            "Excel export (50 tickets) took {$time}ms");
    }

    public function test_excel_export_medium_dataset(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(500);

        $this->asAdmin();

        $time = $this->measureTime(function () {
            $this->getJson('/analytics/export/excel')->assertOk();
        });

        $this->assertLessThanOrEqual(8000, $time,
            "Excel export (500 tickets) took {$time}ms");
    }

    public function test_csv_export_memory_usage(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);
        $this->seedTickets(500);

        $this->asAdmin();

        gc_collect_cycles();

        $memory = $this->measureMemory(function () {
            $this->getJson('/analytics/export/csv');
        });

        $this->assertLessThanOrEqual(200 * 1024 * 1024, $memory['peak'],
            "CSV export peak memory: ".round($memory['peak'] / 1024 / 1024, 2).'MB');
    }

    public function test_pdf_export_memory_usage(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(50);

        $this->asAdmin();

        gc_collect_cycles();

        $memory = $this->measureMemory(function () {
            $this->getJson('/analytics/export/pdf');
        });

        $this->assertLessThanOrEqual(200 * 1024 * 1024, $memory['peak'],
            "PDF export peak memory: ".round($memory['peak'] / 1024 / 1024, 2).'MB');
    }

    public function test_excel_export_memory_usage(): void
    {
        $this->seedRooms(3);
        $this->seedEquipments(5);
        $this->seedTickets(100);

        $this->asAdmin();

        gc_collect_cycles();

        $memory = $this->measureMemory(function () {
            $this->getJson('/analytics/export/excel');
        });

        $this->assertLessThanOrEqual(200 * 1024 * 1024, $memory['peak'],
            "Excel export peak memory: ".round($memory['peak'] / 1024 / 1024, 2).'MB');
    }

    public function test_export_scaling_comparison(): void
    {
        $this->seedRooms(5);
        $this->seedEquipments(10);

        $this->asAdmin();

        $counts = [50, 200, 500];
        $times = [];

        foreach ($counts as $count) {
            Ticket::query()->delete();
            $this->seedTickets($count);

            $times[$count] = $this->measureTime(function () {
                $this->getJson('/analytics/export/csv')->assertOk();
            });
        }

        if ($times[50] > 0) {
            $ratio = $times[500] / $times[50];
            $this->assertLessThanOrEqual(20, $ratio,
                "Export scaling is non-linear: 500/50 ratio = {$ratio}");
        }
    }
}
