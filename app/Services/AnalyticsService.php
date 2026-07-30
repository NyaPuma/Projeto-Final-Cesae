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
     * Obtém o payload completo para o painel analítico.
     *
     * @return array<string, mixed>
     */
    public function getDashboardPayload(): array
    {
        return $this->dashboardService->getDashboardPayload();
    }

    /**
     * Exporta os dados analíticos em formato CSV para a saída padrão.
     */
    public function exportCsv(): void
    {
        $this->exportService->exportCsv();
    }

    /**
     * Exporta os dados analíticos para um ficheiro CSV no caminho especificado.
     *
     * @param string $path
     */
    public function exportCsvToFile(string $path): void
    {
        $this->exportService->exportCsvToFile($path);
    }

    /**
     * Exporta o relatório analítico em formato PDF para o caminho especificado.
     *
     * @param string $path
     */
    public function exportPdfToFile(string $path): void
    {
        $this->exportService->exportPdfToFile($path);
    }
}
