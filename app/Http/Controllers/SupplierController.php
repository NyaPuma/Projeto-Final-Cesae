<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\CreateSupplierAction;
use App\Actions\UpdateSupplierAction;
use App\DTOs\StoreSupplierData;
use App\DTOs\UpdateSupplierData;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use OpenApi\Attributes as OA;

final class SupplierController extends Controller
{
    public function __construct(
        private readonly CreateSupplierAction $createSupplierAction,
        private readonly UpdateSupplierAction $updateSupplierAction,
    ) {}

    /**
     * Paginated listing of suppliers.
     */
    #[OA\Get(
        path: '/stock/suppliers',
        tags: ['Stock'],
        summary: 'Listar fornecedores',
        description: 'Lista paginada de fornecedores, com pesquisa por nome ou NIF.',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'q', in: 'query', required: false, description: 'Pesquisa por nome ou NIF', schema: new OA\Schema(type: 'string')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Lista paginada de fornecedores'),
            new OA\Response(response: 403, description: 'Acesso proibido para o perfil'),
        ]
    )]
    public function index(Request $request): JsonResponse
    {
        $this->authorize('viewAny', Supplier::class);

        $query = Supplier::query();

        if ($request->filled('q')) {
            $safe = Str::of($request->query('q'))->replace('%', '\\%')->replace('_', '\\_');
            $query->where(function ($sub) use ($safe): void {
                $sub->where('name', 'like', "%{$safe}%")
                    ->orWhere('nif', 'like', "%{$safe}%");
            });
        }

        $suppliers = $query->orderBy('name')->paginate(15);

        return response()->json([
            'suppliers' => SupplierResource::collection($suppliers),
            'pagination' => [
                'current_page' => $suppliers->currentPage(),
                'last_page' => $suppliers->lastPage(),
                'total' => $suppliers->total(),
            ],
        ]);
    }

    /**
     * Supplier detail view.
     */
    #[OA\Get(
        path: '/stock/suppliers/{supplier}',
        tags: ['Stock'],
        summary: 'Detalhe de um fornecedor',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'supplier', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Fornecedor com as peças associadas'),
            new OA\Response(response: 404, description: 'Fornecedor não encontrado'),
        ]
    )]
    public function show(Supplier $supplier): JsonResponse
    {
        $this->authorize('view', $supplier);

        return response()->json([
            'supplier' => new SupplierResource($supplier->load('parts')),
        ]);
    }

    /**
     * Creates a new supplier.
     */
    #[OA\Post(
        path: '/admin/suppliers',
        tags: ['Admin Stock'],
        summary: 'Criar fornecedor',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name'],
                properties: [
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'nif', type: 'string'),
                    new OA\Property(property: 'contact', type: 'string'),
                    new OA\Property(property: 'email', type: 'string'),
                    new OA\Property(property: 'address', type: 'string'),
                    new OA\Property(property: 'avg_lead_time_days', type: 'integer'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 201, description: 'Fornecedor criado com sucesso'),
            new OA\Response(response: 422, description: 'Dados inválidos'),
        ]
    )]
    public function store(StoreSupplierRequest $request): JsonResponse
    {
        $this->authorize('create', Supplier::class);

        $data = StoreSupplierData::fromRequest($request->validated());
        $supplier = $this->createSupplierAction->execute($data);

        return response()->json([
            'message' => __('messages.Fornecedor criado com sucesso.'),
            'supplier' => new SupplierResource($supplier),
        ], 201);
    }

    /**
     * Updates a supplier.
     */
    #[OA\Patch(
        path: '/admin/suppliers/{supplier}',
        tags: ['Admin Stock'],
        summary: 'Atualizar fornecedor',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'supplier', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['name'],
                properties: [
                    new OA\Property(property: 'name', type: 'string'),
                    new OA\Property(property: 'nif', type: 'string'),
                    new OA\Property(property: 'contact', type: 'string'),
                    new OA\Property(property: 'email', type: 'string'),
                    new OA\Property(property: 'address', type: 'string'),
                    new OA\Property(property: 'avg_lead_time_days', type: 'integer'),
                ]
            )
        ),
        responses: [
            new OA\Response(response: 200, description: 'Fornecedor atualizado com sucesso'),
            new OA\Response(response: 422, description: 'Dados inválidos'),
        ]
    )]
    public function update(UpdateSupplierRequest $request, Supplier $supplier): JsonResponse
    {
        $this->authorize('update', $supplier);

        $data = UpdateSupplierData::fromRequest($request->validated());
        $supplier = $this->updateSupplierAction->execute($supplier, $data);

        return response()->json([
            'message' => __('messages.Fornecedor atualizado com sucesso.'),
            'supplier' => new SupplierResource($supplier),
        ]);
    }

    /**
     * Soft-deletes a supplier.
     */
    #[OA\Delete(
        path: '/admin/suppliers/{supplier}',
        tags: ['Admin Stock'],
        summary: 'Eliminar fornecedor',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'supplier', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Fornecedor eliminado com sucesso'),
            new OA\Response(response: 404, description: 'Fornecedor não encontrado'),
        ]
    )]
    public function destroy(Supplier $supplier): JsonResponse
    {
        $this->authorize('delete', $supplier);

        $supplier->delete();

        return response()->json([
            'message' => __('messages.Fornecedor eliminado com sucesso.'),
        ]);
    }
}
