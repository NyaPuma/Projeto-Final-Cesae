<?php

namespace Tests\Unit\Services;

use App\Services\AnalyticsService;
use App\Services\TicketStatusService;
use Illuminate\Support\Facades\Cache;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\CreatesTickets;

class AnalyticsServiceTest extends FeatureTestCase
{
    use CreatesTickets;

    private AnalyticsService $service;

    protected function setUp(): void
    {
        parent::setUp();

        app(TicketStatusService::class)->flush();
        Cache::forget('analytics_dashboard_payload');

        $this->service = app(AnalyticsService::class);
    }

    #[Test]
    public function it_returns_the_dashboard_payload_with_expected_sections(): void
    {
        $payload = $this->service->getDashboardPayload();

        $this->assertIsArray($payload);
        $this->assertArrayHasKey('open_tickets', $payload);
        $this->assertArrayHasKey('closed_tickets', $payload);
        $this->assertArrayHasKey('by_priority', $payload);
        $this->assertArrayHasKey('recent_activity', $payload);
    }

    #[Test]
    public function it_exports_the_analytics_report_to_a_csv_file(): void
    {
        $this->createTicket(['title' => 'Ticket CSV Export']);

        $path = storage_path('framework/testing/exports/analytics.csv');

        $this->service->exportCsvToFile($path);

        $this->assertFileExists($path);
        $this->assertStringContainsString('Ticket CSV Export', file_get_contents($path));

        unlink($path);
    }

    #[Test]
    public function it_exports_the_analytics_report_to_standard_output(): void
    {
        $this->createTicket(['title' => 'Ticket Stdout Export']);

        ob_start();
        $this->service->exportCsv();
        $output = ob_get_clean();

        $this->assertStringContainsString('Ticket Stdout Export', $output);
    }

    #[Test]
    public function it_exports_the_analytics_report_to_a_pdf_file(): void
    {
        $this->createTicket(['title' => 'Ticket PDF Export']);

        $path = storage_path('framework/testing/exports/analytics.pdf');

        $this->service->exportPdfToFile($path);

        $this->assertFileExists($path);
        $this->assertStringStartsWith('%PDF', file_get_contents($path));

        unlink($path);
    }
}
