<?php

namespace App\Http\Controllers;

use App\Exports\TicketsExport;
use App\Jobs\ExportCsvJob;
use App\Jobs\ExportExcelJob;
use App\Jobs\ExportPdfJob;
use App\Models\Ticket;
use App\Services\AnalyticsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class AnalyticsController extends Controller
{
    public function __construct(
        private readonly AnalyticsService $analyticsService,
    ) {}

    /**
     * Retorna os dados analíticos e métricas do dashboard.
     */
    public function stats(Request $request): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('viewAnalytics', Ticket::class);

        return response()->json(
            $this->analyticsService->getDashboardPayload()
        );
    }

    /**
     * Dispara o processamento assíncrono para exportação em CSV.
     */
    public function exportCsv(Request $request): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('exportAnalytics', Ticket::class);

        $user = $request->user();

        // 2. Dispara o job assíncrono em background
        ExportCsvJob::dispatch($user->id);

        return response()->json([
            'message' => __('common.Exportação CSV em processamento. Receberá uma notificação quando estiver pronta.'),
        ]);
    }

    /**
     * Dispara o processamento assíncrono para exportação em PDF.
     */
    public function exportPdf(Request $request): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('exportAnalytics', Ticket::class);

        $user = $request->user();

        // 2. Dispara o job assíncrono em background
        ExportPdfJob::dispatch($user->id);

        return response()->json([
            'message' => __('common.Exportação PDF em processamento. Receberá uma notificação quando estiver pronta.'),
        ]);
    }

    /**
     * Dispara o processamento assíncrono para exportação em Excel.
     */
    public function exportExcel(Request $request): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('exportAnalytics', Ticket::class);

        $user = $request->user();

        // 2. Dispara o job assíncrono em background
        ExportExcelJob::dispatch($user->id);

        return response()->json([
            'message' => __('common.Exportação Excel em processamento. Receberá uma notificação quando estiver pronta.'),
        ]);
    }
}
