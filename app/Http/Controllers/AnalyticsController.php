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
     * Returns the dashboard's analytical data and metrics.
     */
    public function stats(Request $request): JsonResponse
    {
        // 1. Authorization via Policy
        $this->authorize('viewAnalytics', Ticket::class);

        return response()->json(
            $this->analyticsService->getDashboardPayload()
        );
    }

    /**
     * Dispatches asynchronous processing for CSV export.
     */
    public function exportCsv(Request $request): JsonResponse
    {
        // 1. Authorization via Policy
        $this->authorize('exportAnalytics', Ticket::class);

        $user = $request->user();

        // 2. Dispatch the asynchronous background job
        ExportCsvJob::dispatch($user->id);

        return response()->json([
            'message' => __('common.Exportação CSV em processamento. Receberá uma notificação quando estiver pronta.'),
        ]);
    }

    /**
     * Dispatches asynchronous processing for PDF export.
     */
    public function exportPdf(Request $request): JsonResponse
    {
        // 1. Authorization via Policy
        $this->authorize('exportAnalytics', Ticket::class);

        $user = $request->user();

        // 2. Dispatch the asynchronous background job
        ExportPdfJob::dispatch($user->id);

        return response()->json([
            'message' => __('common.Exportação PDF em processamento. Receberá uma notificação quando estiver pronta.'),
        ]);
    }

    /**
     * Dispatches asynchronous processing for Excel export.
     */
    public function exportExcel(Request $request): JsonResponse
    {
        // 1. Authorization via Policy
        $this->authorize('exportAnalytics', Ticket::class);

        $user = $request->user();

        // 2. Dispatch the asynchronous background job
        ExportExcelJob::dispatch($user->id);

        return response()->json([
            'message' => __('common.Exportação Excel em processamento. Receberá uma notificação quando estiver pronta.'),
        ]);
    }
}
