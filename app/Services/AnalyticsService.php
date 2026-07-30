<?php

namespace App\Services;

final class AnalyticsService
{
    public function __construct(
        private readonly AnalyticsDashboardService $dashboardService,
        private readonly AnalyticsExportService $exportService,
    ) {}

    public function getDashboardPayload(): array
    {
        return $this->dashboardService->getDashboardPayload();
    }

    public function exportCsv(): void
    {
        $this->exportService->exportCsv();
    }

    public function exportCsvToFile(string $path): void
    {
        $this->exportService->exportCsvToFile($path);
    }

    public function exportPdfToFile(string $path): void
    {
        $this->exportService->exportPdfToFile($path);
    }
}
