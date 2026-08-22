<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\MaintenancePlanActions;
use App\Enums\MaintenancePlanIntervalTypeEnum;
use App\Http\Requests\StoreMaintenancePlanRequest;
use App\Http\Requests\UpdateMaintenancePlanRequest;
use App\Http\Resources\MaintenancePlanResource;
use App\Models\Equipment;
use App\Models\MaintenancePlan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

final class MaintenancePlanController extends Controller
{
    public function __construct(
        private readonly MaintenancePlanActions $maintenancePlanActions,
    ) {}

    /**
     * Paginated listing of preventive maintenance plans.
     */
    #[OA\Get(
        path: '/admin/maintenance-plans',
        tags: ['Admin Stock'],
        summary: 'Listar planos de manutenção preventiva',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'equipment_id', in: 'query', required: false, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Lista paginada de planos'),
        ]
    )]
    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', MaintenancePlan::class);

        $query = MaintenancePlan::query()->with(['equipment']);

        if ($request->filled('equipment_id')) {
            $query->where('equipment_id', (int) $request->query('equipment_id'));
        }

        $plans = $query->orderBy('name')->paginate(15);

        return response()->json([
            'plans' => MaintenancePlanResource::collection($plans),
            'pagination' => [
                'current_page' => $plans->currentPage(),
                'last_page' => $plans->lastPage(),
                'total' => $plans->total(),
            ],
        ]);
    }

    /**
     * Plan detail with associated parts.
     */
    #[OA\Get(
        path: '/admin/maintenance-plans/{plan}',
        tags: ['Admin Stock'],
        summary: 'Detalhe de um plano de manutenção',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'plan', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Plano com equipamento e peças associadas'),
            new OA\Response(response: 404, description: 'Plano não encontrado'),
        ]
    )]
    public function show(MaintenancePlan $plan): JsonResponse
    {
        $this->authorize('view', $plan);

        return response()->json([
            'plan' => new MaintenancePlanResource($plan->load(['equipment', 'parts'])),
        ]);
    }

    /**
     * Creates a new preventive maintenance plan.
     */
    #[OA\Post(
        path: '/admin/maintenance-plans',
        tags: ['Admin Stock'],
        summary: 'Criar plano de manutenção preventiva',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['equipment_id', 'name', 'interval_type', 'interval_value'],
                properties: [
                    new OA\Property(property: 'equipment_id', type: 'integer'),
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'interval_type', type: 'string', enum: ['days', 'usage_hours', 'cycles']),
                    new OA\Property(property: 'interval_value', type: 'integer'),
                    new OA\Property(property: 'description', type: 'string'),
                    new OA\Property(property: 'active', type: 'boolean'),
                    new OA\Property(
                        property: 'parts',
                        type: 'array',
                        description: 'Peças do plano',
                        items: new OA\Items(
                            type: 'object',
                            properties: [
                                new OA\Property(property: 'part_id', type: 'integer'),
                                new OA\Property(property: 'expected_quantity', type: 'integer'),
                            ]
                        )
                    ),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Plano criado com sucesso'),
            new OA\Response(response: 422, description: 'Dados inválidos'),
        ]
    )]
    public function store(StoreMaintenancePlanRequest $request): JsonResponse
    {
        $this->authorize('create', MaintenancePlan::class);

        $validated = $request->validated();

        $equipment = Equipment::query()->findOrFail((int) $validated['equipment_id']);

        $intervalType = MaintenancePlanIntervalTypeEnum::normalize($validated['interval_type'])
            ?? MaintenancePlanIntervalTypeEnum::Days;

        $plan = $this->maintenancePlanActions->create(
            equipment: $equipment,
            name: $validated['name'],
            intervalType: $intervalType,
            intervalValue: (int) $validated['interval_value'],
            description: $validated['description'] ?? null,
            active: (bool) ($validated['active'] ?? true),
            parts: $this->partsPayload($request),
        );

        return response()->json([
            'message' => __('messages.Plano de manutenção criado com sucesso.'),
            'plan' => new MaintenancePlanResource($plan),
        ], 201);
    }

    /**
     * Updates a preventive maintenance plan.
     */
    #[OA\Patch(
        path: '/admin/maintenance-plans/{plan}',
        tags: ['Admin Stock'],
        summary: 'Atualizar plano de manutenção preventiva',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'plan', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['equipment_id', 'name', 'interval_type', 'interval_value'],
                properties: [
                    new OA\Property(property: 'equipment_id', type: 'integer'),
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'interval_type', type: 'string', enum: ['days', 'usage_hours', 'cycles']),
                    new OA\Property(property: 'interval_value', type: 'integer'),
                    new OA\Property(property: 'description', type: 'string'),
                    new OA\Property(property: 'active', type: 'boolean'),
                    new OA\Property(
                        property: 'parts',
                        type: 'array',
                        items: new OA\Items(
                            type: 'object',
                            properties: [
                                new OA\Property(property: 'part_id', type: 'integer'),
                                new OA\Property(property: 'expected_quantity', type: 'integer'),
                            ]
                        )
                    ),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Plano atualizado com sucesso'),
            new OA\Response(response: 422, description: 'Dados inválidos'),
        ]
    )]
    public function update(UpdateMaintenancePlanRequest $request, MaintenancePlan $plan): JsonResponse
    {
        $this->authorize('update', $plan);

        $validated = $request->validated();

        $intervalType = MaintenancePlanIntervalTypeEnum::normalize($validated['interval_type'])
            ?? MaintenancePlanIntervalTypeEnum::Days;

        $plan = $this->maintenancePlanActions->update(
            plan: $plan,
            name: $validated['name'],
            intervalType: $intervalType,
            intervalValue: (int) $validated['interval_value'],
            description: $validated['description'] ?? null,
            active: (bool) ($validated['active'] ?? true),
            parts: $this->partsPayload($request),
        );

        return response()->json([
            'message' => __('messages.Plano de manutenção atualizado com sucesso.'),
            'plan' => new MaintenancePlanResource($plan),
        ]);
    }

    /**
     * Soft-deletes a plan.
     */
    #[OA\Delete(
        path: '/admin/maintenance-plans/{plan}',
        tags: ['Admin Stock'],
        summary: 'Eliminar plano de manutenção preventiva',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'plan', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Plano eliminado com sucesso'),
            new OA\Response(response: 404, description: 'Plano não encontrado'),
        ]
    )]
    public function destroy(MaintenancePlan $plan): JsonResponse
    {
        $this->authorize('delete', $plan);

        $plan->delete();

        return response()->json([
            'message' => __('messages.Plano de manutenção eliminado com sucesso.'),
        ]);
    }

    /**
     * Converts the parts list [id, expected_quantity] into a part_id => quantity map.
     *
     * @return array<int, int>
     */
    private function partsPayload(Request $request): array
    {
        $payload = [];

        if (! $request->filled('parts')) {
            return $payload;
        }

        foreach ((array) $request->input('parts') as $entry) {
            if (! is_array($entry)) {
                continue;
            }

            $partId = (int) ($entry['part_id'] ?? $entry['id'] ?? 0);
            $quantity = (int) ($entry['expected_quantity'] ?? 1);

            if ($partId > 0) {
                $payload[$partId] = max(1, $quantity);
            }
        }

        return $payload;
    }
}
