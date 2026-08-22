<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Part;
use App\Services\LowStockAlertService;
use App\Services\StockDashboardService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        summary: 'Resumo do dashboard de stock',
        description: 'Valor total do stock, total de peças, contagem de peças com stock baixo e lista de alertas.',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 200, description: 'Resumo de métricas de stock'),
        ]
    )]
    public function summary(): JsonResponse
    {
        $this->authorize('viewAny', Part::class);

        return response()->json([
            'total_stock_value' => $this->dashboardService->totalStockValue(),
            'total_parts' => $this->dashboardService->totalParts(),
            'low_stock_count' => $this->dashboardService->lowStockCount(),
            'parts_in_alert' => $this->lowStockAlertService->partsInAlert(),
        ]);
    }

    /**
     * Top most-consumed parts in a period.
     */
    #[OA\Get(
        path: '/stock/dashboard/top-consumed',
        tags: ['Stock'],
        summary: 'Peças mais consumidas',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'from', in: 'query', required: false, schema: new OA\Schema(type: 'string', format: 'date')),
            new OA\Parameter(name: 'to', in: 'query', required: false, schema: new OA\Schema(type: 'string', format: 'date')),
            new OA\Parameter(name: 'limit', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Lista das peças mais consumidas'),
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
        summary: 'Peças com stock parado',
        description: 'Peças ativas sem movimentos há X dias, ordenadas por stock atual.',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'inactive_days', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'limit', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Lista de peças com stock parado'),
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
        summary: 'Custo de peças por equipamento',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'from', in: 'query', required: false, schema: new OA\Schema(type: 'string', format: 'date')),
            new OA\Parameter(name: 'to', in: 'query', required: false, schema: new OA\Schema(type: 'string', format: 'date')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Custos de peças por equipamento'),
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
        summary: 'Custo de peças por ticket',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'from', in: 'query', required: false, schema: new OA\Schema(type: 'string', format: 'date')),
            new OA\Parameter(name: 'to', in: 'query', required: false, schema: new OA\Schema(type: 'string', format: 'date')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Custos de peças por ticket'),
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
        summary: 'Previsão de rutura de stock',
        description: 'Estimativa de meses de stock restantes com base no consumo médio mensal.',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'months', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Previsão de rutura de stock'),
        ]
    )]
    public function runoutForecast(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Part::class);

        return response()->json([
            'items' => $this->dashboardService->stockRunoutForecast(
                months: (int) ($request->query('months') ?? 3),
            ),
        ]);
    }
}
