<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Part;
use App\Services\LowStockAlertService;
use App\Services\StockDashboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use OpenApi\Attributes as OA;

final class StockDashboardController extends Controller
{
    public function __construct(
        private readonly StockDashboardService $dashboardService,
        private readonly LowStockAlertService $lowStockAlertService,
    ) {}

    /**
     * General stock statistics for the dashboard.
     */
    #[OA\Get(
        path: '/stock/dashboard/summary',
        tags: ['Stock'],
        summary: 'Stock dashboard summary',
        description: 'Total stock value, total parts, count of low-stock parts, and list of alerts.',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Stock metrics summary'),
        ]
    )]
    public function summary(): JsonResponse
    {
        $this->authorize('viewAny', Part::class);

        return response()->json(Cache::remember('stock_dashboard_summary', 60, function (): array {
            return [
                'total_stock_value' => $this->dashboardService->totalStockValue(),
                'total_parts' => $this->dashboardService->totalParts(),
                'low_stock_count' => $this->dashboardService->lowStockCount(),
                'parts_in_alert' => $this->lowStockAlertService->partsInAlert(),
            ];
        }));
    }

    /**
     * Top most-consumed parts in a period.
     */
    #[OA\Get(
        path: '/stock/dashboard/top-consumed',
        tags: ['Stock'],
        summary: 'Most consumed parts',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'from', in: 'query', required: false, schema: new OA\Schema(type: 'string', format: 'date')),
            new OA\Parameter(name: 'to', in: 'query', required: false, schema: new OA\Schema(type: 'string', format: 'date')),
            new OA\Parameter(name: 'limit', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'List of most consumed parts'),
        ]
    )]
    public function topConsumed(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Part::class);

        return response()->json([
            'items' => $this->dashboardService->topConsumed(
                from: $request->query('from'),
                to: $request->query('to'),
                limit: (int) ($request->query('limit') ?? 10),
            ),
        ]);
    }

    /**
     * Slow-moving parts (capital tied up).
     */
    #[OA\Get(
        path: '/stock/dashboard/slow-moving',
        tags: ['Stock'],
        summary: 'Slow-moving parts',
        description: 'Active parts with no movements for X days, sorted by current stock.',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'inactive_days', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'limit', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'List of slow-moving parts'),
        ]
    )]
    public function slowMoving(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Part::class);

        return response()->json([
            'items' => $this->dashboardService->slowMovingParts(
                inactiveDays: (int) ($request->query('inactive_days') ?? 90),
                limit: (int) ($request->query('limit') ?? 20),
            ),
        ]);
    }

    /**
     * Cost of parts by equipment.
     */
    #[OA\Get(
        path: '/stock/dashboard/cost-by-equipment',
        tags: ['Stock'],
        summary: 'Cost of parts by equipment',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'from', in: 'query', required: false, schema: new OA\Schema(type: 'string', format: 'date')),
            new OA\Parameter(name: 'to', in: 'query', required: false, schema: new OA\Schema(type: 'string', format: 'date')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Part costs by equipment'),
        ]
    )]
    public function costByEquipment(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Part::class);

        return response()->json([
            'items' => $this->dashboardService->costByEquipment(
                from: $request->query('from'),
                to: $request->query('to'),
            ),
        ]);
    }

    /**
     * Cost of parts by ticket/intervention.
     */
    #[OA\Get(
        path: '/stock/dashboard/cost-by-ticket',
        tags: ['Stock'],
        summary: 'Cost of parts by ticket',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'from', in: 'query', required: false, schema: new OA\Schema(type: 'string', format: 'date')),
            new OA\Parameter(name: 'to', in: 'query', required: false, schema: new OA\Schema(type: 'string', format: 'date')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Part costs by ticket'),
        ]
    )]
    public function costByTicket(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Part::class);

        return response()->json([
            'items' => $this->dashboardService->costByTicket(
                from: $request->query('from'),
                to: $request->query('to'),
            ),
        ]);
    }

    /**
     * Stock runout forecast.
     */
    #[OA\Get(
        path: '/stock/dashboard/runout-forecast',
        tags: ['Stock'],
        summary: 'Stock runout forecast',
        description: 'Estimate of remaining months of stock based on average monthly consumption.',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'months', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Stock runout forecast'),
        ]
    )]
    public function runoutForecast(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Part::class);

        $months = (int) ($request->query('months') ?? 3);

        return response()->json(Cache::remember("stock_dashboard_runout:{$months}", 60, function () use ($months): array {
            return [
                'items' => $this->dashboardService->stockRunoutForecast(months: $months),
            ];
        }));
    }
}
