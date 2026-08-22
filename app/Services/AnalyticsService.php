<?php

declare(strict_types=1);

namespace App\Services;

final class AnalyticsService
{
    /**
     * @param AnalyticsDashboardService $dashboardService
     * @param AnalyticsExportService $exportService
     */
    public function __construct(
        private readonly AnalyticsDashboardService $dashboardService,
        private readonly AnalyticsExportService $exportService,
    ) {}

    /**
     * Gets the complete payload for the analytics dashboard.
     *
     * @return array<string, mixed>
     */
    public function getDashboardPayload(): array
    {
        return $this->dashboardService->getDashboardPayload();
    }

    /**
     * Exports analytics data in CSV format to standard output.
     */
    public function exportCsv(): void
    {
        $this->exportService->exportCsv();
    }

    /**
     * Exports analytics data to a CSV file at the specified path.
     *
     * @param string $path
     */
    public function exportCsvToFile(string $path): void
    {
        $this->exportService->exportCsvToFile($path);
    }

    /**
     * Exports the analytics report in PDF format to the specified path.
     *
     * @param string $path
     */
    public function exportPdfToFile(string $path): void
    {
        $this->exportService->exportPdfToFile($path);
    }
}
