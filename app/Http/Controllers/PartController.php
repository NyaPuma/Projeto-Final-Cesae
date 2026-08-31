<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreatePartAction;
use App\Actions\UpdatePartAction;
use App\DTOs\StorePartData;
use App\DTOs\UpdatePartData;
use App\Http\Requests\StorePartRequest;
use App\Http\Requests\UpdatePartRequest;
use App\Http\Resources\PartResource;
use App\Models\Part;
use App\Services\PartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use OpenApi\Attributes as OA;

final class PartController extends Controller
{
    public function __construct(
        private readonly PartService $partService,
        private readonly CreatePartAction $createPartAction,
        private readonly UpdatePartAction $updatePartAction,
    ) {}

    /**
     * Paginated listing of parts.
     */
    #[OA\Get(
        path: '/stock/parts',
        tags: ['Stock'],
        summary: 'List parts',
        description: 'Paginated list of catalogue parts, filterable by search, status, and category.',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'q', in: 'query', required: false, description: 'Search by SKU or name', schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'status', in: 'query', required: false, description: 'Stock status (low_stock, out_of_stock, healthy)', schema: new OA\Schema(type: 'string')),
            new OA\Parameter(name: 'category_id', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
            new OA\Parameter(name: 'per_page', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Paginated list of parts'),
            new OA\Response(response: 401, description: 'Authentication required'),
            new OA\Response(response: 403, description: 'Access forbidden for the profile'),
        ]
    )]
    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Part::class);

        $parts = $this->partService->listPaginated(
            search: $request->query('q'),
            status: $request->query('status'),
            categoryId: $request->query('category_id') !== null ? (int) $request->query('category_id') : null,
            perPage: (int) ($request->query('per_page') ?? 15),
        );

        return response()->json([
            'parts' => PartResource::collection($parts),
            'pagination' => [
                'current_page' => $parts->currentPage(),
                'last_page' => $parts->lastPage(),
                'total' => $parts->total(),
            ],
        ]);
    }

    /**
     * Part detail view.
     */
    #[OA\Get(
        path: '/stock/parts/{part}',
        tags: ['Stock'],
        summary: 'Part detail',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'part', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Part with category, VAT rate, and suppliers'),
            new OA\Response(response: 404, description: 'Part not found'),
        ]
    )]
    public function show(Part $part): JsonResponse
    {
        $this->authorize('view', $part);

        return response()->json([
            'part' => new PartResource($part->load(['category', 'taxRate', 'suppliers'])),
        ]);
    }

    /**
     * Creates a new part.
     */
    #[OA\Post(
        path: '/admin/parts',
        tags: ['Admin Stock'],
        summary: 'Create part',
        description: 'Creates a part and records the initial stock as an inward movement.',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['sku', 'name', 'unit_of_measure', 'cost_price', 'current_stock', 'min_stock'],
                properties: [
                    new OA\Property(property: 'sku', type: 'string', description: 'Unique code (SKU)'),
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'description', type: 'string'),
                    new OA\Property(property: 'brand', type: 'string'),
                    new OA\Property(property: 'manufacturer_ref', type: 'string'),
                    new OA\Property(property: 'part_category_id', type: 'integer'),
                    new OA\Property(property: 'unit_of_measure', type: 'string', enum: ['unit', 'meter', 'liter', 'kg', 'pair', 'set', 'roll', 'other']),
                    new OA\Property(property: 'cost_price', type: 'number'),
                    new OA\Property(property: 'tax_rate_id', type: 'integer'),
                    new OA\Property(property: 'sale_price', type: 'number'),
                    new OA\Property(property: 'current_stock', type: 'integer'),
                    new OA\Property(property: 'min_stock', type: 'integer'),
                    new OA\Property(property: 'max_stock', type: 'integer'),
                    new OA\Property(property: 'location', type: 'string'),
                    new OA\Property(property: 'active', type: 'boolean'),
                    new OA\Property(property: 'technical_notes', type: 'string'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Part created successfully'),
            new OA\Response(response: 422, description: 'Invalid data'),
        ]
    )]
    public function store(StorePartRequest $request): JsonResponse
    {
        $this->authorize('create', Part::class);

        $data = StorePartData::fromRequest($request->validated());
        $part = $this->createPartAction->execute($data);
        Cache::forget('stock_dashboard_summary');

        return response()->json([
            'message' => __('messages.Peça criada com sucesso.'),
            'part' => new PartResource($part),
        ], 201);
    }

    /**
     * Updates a part.
     */
    #[OA\Patch(
        path: '/admin/parts/{part}',
        tags: ['Admin Stock'],
        summary: 'Update part',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'part', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['sku', 'name', 'unit_of_measure', 'cost_price', 'min_stock'],
                properties: [
                    new OA\Property(property: 'sku', type: 'string'),
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'description', type: 'string'),
                    new OA\Property(property: 'brand', type: 'string'),
                    new OA\Property(property: 'manufacturer_ref', type: 'string'),
                    new OA\Property(property: 'part_category_id', type: 'integer'),
                    new OA\Property(property: 'unit_of_measure', type: 'string', enum: ['unit', 'meter', 'liter', 'kg', 'pair', 'set', 'roll', 'other']),
                    new OA\Property(property: 'cost_price', type: 'number'),
                    new OA\Property(property: 'tax_rate_id', type: 'integer'),
                    new OA\Property(property: 'sale_price', type: 'number'),
                    new OA\Property(property: 'min_stock', type: 'integer'),
                    new OA\Property(property: 'max_stock', type: 'integer'),
                    new OA\Property(property: 'location', type: 'string'),
                    new OA\Property(property: 'active', type: 'boolean'),
                    new OA\Property(property: 'technical_notes', type: 'string'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Part updated successfully'),
            new OA\Response(response: 422, description: 'Invalid data'),
        ]
    )]
    public function update(UpdatePartRequest $request, Part $part): JsonResponse
    {
        $this->authorize('update', $part);

        $data = UpdatePartData::fromRequest($request->validated());
        $part = $this->updatePartAction->execute($part, $data);
        Cache::forget('stock_dashboard_summary');

        return response()->json([
            'message' => __('messages.Peça atualizada com sucesso.'),
            'part' => new PartResource($part),
        ]);
    }

    /**
     * Soft-deletes a part.
     */
    #[OA\Delete(
        path: '/admin/parts/{part}',
        tags: ['Admin Stock'],
        summary: 'Delete part',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'part', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Part deleted successfully'),
            new OA\Response(response: 404, description: 'Part not found'),
        ]
    )]
    public function destroy(Part $part): JsonResponse
    {
        $this->authorize('delete', $part);

        $part->delete();
        Cache::forget('stock_dashboard_summary');

        return response()->json([
            'message' => __('messages.Peça eliminada com sucesso.'),
        ]);
    }
}
