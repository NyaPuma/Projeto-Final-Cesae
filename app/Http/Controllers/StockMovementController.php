<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\StockMovementTypeEnum;
use App\Http\Requests\StoreStockMovementRequest;
use App\Http\Resources\StockMovementResource;
use App\Models\Part;
use App\Models\StockMovement;
use App\Services\StockMovementService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenApi\Attributes as OA;
use Throwable;

final class StockMovementController extends Controller
{
    public function __construct(
        private readonly StockMovementService $stockMovementService,
    ) {}

    /**
     * Lista paginada de movimentos, com filtros por peça e tipo.
     */
    #[OA\Get(
        path: '/stock/movements',
        tags: ['Stock'],
        summary: 'Listar movimentos de stock',
        description: 'Lista paginada de movimentos, filtrável por peça, tipo de movimento e ticket.',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'part_id', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'movement_type', in: 'query', required: false, schema: new OA\Schema(type: 'string', enum: ['in', 'out', 'adjust', 'return'])),
            new OA\Parameter(name: 'ticket_id', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Lista paginada de movimentos'),
            new OA\Response(response: 403, description: 'Acesso proibido para o perfil'),
        ]
    )]
    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', StockMovement::class);

        $query = StockMovement::query()->with(['part', 'user']);

        if ($request->filled('part_id')) {
            $query->where('part_id', (int) $request->query('part_id'));
        }

        if ($request->filled('movement_type')) {
            $query->where('movement_type', (string) $request->query('movement_type'));
        }

        if ($request->filled('ticket_id')) {
            $query->where('ticket_id', (int) $request->query('ticket_id'));
        }

        $movements = $query->latest()->paginate(20);

        return response()->json([
            'movements' => StockMovementResource::collection($movements),
            'pagination' => [
                'current_page' => $movements->currentPage(),
                'last_page' => $movements->lastPage(),
                'total' => $movements->total(),
            ],
        ]);
    }

    /**
     * Regista um movimento de stock (entrada/saída/ajuste/devolução).
     */
    #[OA\Post(
        path: '/stock/movements',
        tags: ['Stock'],
        summary: 'Registar movimento de stock',
        description: 'Regista um movimento e atualiza atomicamente o stock da peça. Saídas usam quantidade positiva.',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['part_id', 'movement_type', 'quantity'],
                properties: [
                    new OA\Property(property: 'part_id', type: 'integer'),
                    new OA\Property(property: 'movement_type', type: 'string', enum: ['in', 'out', 'adjust', 'return']),
                    new OA\Property(property: 'quantity', type: 'integer'),
                    new OA\Property(property: 'reason', type: 'string'),
                    new OA\Property(property: 'ticket_id', type: 'integer'),
                    new OA\Property(property: 'equipment_id', type: 'integer'),
                    new OA\Property(property: 'unit_price_snapshot', type: 'number'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Movimento registado com sucesso'),
            new OA\Response(response: 422, description: 'Dados inválidos ou stock insuficiente'),
            new OA\Response(response: 500, description: 'Não foi possível registar o movimento'),
        ]
    )]
    public function store(StoreStockMovementRequest $request): JsonResponse
    {
        $this->authorize('create', StockMovement::class);

        $validated = $request->validated();

        $part = Part::query()->findOrFail((int) $validated['part_id']);

        $movementType = StockMovementTypeEnum::normalize($validated['movement_type'])
            ?? StockMovementTypeEnum::Adjust;

        try {
            $movement = $this->stockMovementService->record(
                part: $part,
                movementType: $movementType,
                quantity: (int) $validated['quantity'],
                reason: $validated['reason'] ?? null,
                ticketId: isset($validated['ticket_id']) ? (int) $validated['ticket_id'] : null,
                equipmentId: isset($validated['equipment_id']) ? (int) $validated['equipment_id'] : null,
                user: $request->user(),
                unitPriceSnapshot: isset($validated['unit_price_snapshot']) ? (float) $validated['unit_price_snapshot'] : null,
            );
        } catch (\InvalidArgumentException $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'errors' => ['quantity' => [$e->getMessage()]],
            ], 422);
        } catch (Throwable $e) {
            Log::error('Erro ao registar movimento de stock', [
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => __('common.Não foi possível registar o movimento.'),
            ], 500);
        }

        return response()->json([
            'message' => __('messages.Movimento de stock registado com sucesso.'),
            'movement' => new StockMovementResource($movement->load(['part', 'user'])),
        ], 201);
    }
}
