<?php

namespace App\Http\Controllers;

use App\Actions\CreateEquipmentAction;
use App\Actions\UpdateEquipmentAction;
use App\DTOs\StoreEquipmentData;
use App\DTOs\UpdateEquipmentData;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use App\Repositories\Contracts\EquipmentRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class AdminEquipmentController extends Controller
{
    public function __construct(
        private readonly EquipmentRepositoryInterface $equipmentRepository,
        private readonly CreateEquipmentAction $createEquipmentAction,
        private readonly UpdateEquipmentAction $updateEquipmentAction,
    ) {}

    /**
     * Lista todos os equipamentos registados no sistema.
     */
    public function index(Request $request): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('viewAny', Equipment::class);

        // 2. Procura de equipamentos (suporta paginação se implementada no repositório)
        $equipments = $this->equipmentRepository->getAll();

        return response()->json([
            'equipments' => EquipmentResource::collection($equipments),
        ]);
    }

    /**
     * Cria um novo equipamento no sistema.
     */
    public function store(StoreEquipmentRequest $request): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('create', Equipment::class);

        // 2. Executa DTO e Action para criar o equipamento
        $data = StoreEquipmentData::fromRequest($request->validated());
        $equipment = $this->createEquipmentAction->execute($data);

        $equipment->loadMissing('room');

        return response()->json([
            'message' => __('messages.Equipamento criado com sucesso.'),
            'equipment' => new EquipmentResource($equipment),
        ], 201);
    }

    /**
     * Atualiza os dados de um equipamento existente.
     */
    public function update(UpdateEquipmentRequest $request, Equipment $equipment): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('update', $equipment);

        // 2. Executa DTO e Action para atualizar
        $data = UpdateEquipmentData::fromRequest($request->validated());
        $updatedEquipment = $this->updateEquipmentAction->execute($equipment, $data);

        $updatedEquipment->loadMissing('room');

        return response()->json([
            'message' => __('messages.Equipamento atualizado com sucesso.'),
            'equipment' => new EquipmentResource($updatedEquipment),
        ]);
    }

    /**
     * Elimina um equipamento do sistema.
     */
    public function destroy(Request $request, Equipment $equipment): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('delete', $equipment);

        // 2. Executa a remoção via Repositório
        $this->equipmentRepository->delete($equipment);

        return response()->json([
            'message' => __('messages.Equipamento eliminado com sucesso.'),
        ]);
    }
}
