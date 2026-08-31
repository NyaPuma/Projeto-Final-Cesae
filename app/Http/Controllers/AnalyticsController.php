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
use OpenApi\Attributes as OA;

final class AnalyticsController extends Controller
{
    public function __construct(
        private readonly AnalyticsService $analyticsService,
    ) {}

    /**
     * Returns the dashboard's analytical data and metrics.
     */
    #[OA\Get(
        path: '/analytics/stats',
        tags: ['Analytics'],
        summary: 'Estatísticas do dashboard',
        description: 'Devolve o payload analítico agregado do dashboard.',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Métricas e dados analíticos'),
        ]
    )]
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
    #[OA\Get(
        path: '/analytics/export/csv',
        tags: ['Analytics'],
        summary: 'Exportar CSV',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Exportação CSV em processamento'),
        ]
    )]
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
    #[OA\Get(
        path: '/analytics/export/pdf',
        tags: ['Analytics'],
        summary: 'Exportar PDF',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Exportação PDF em processamento'),
        ]
    )]
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
    #[OA\Get(
        path: '/analytics/export/excel',
        tags: ['Analytics'],
        summary: 'Exportar Excel',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Exportação Excel em processamento'),
        ]
    )]
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
