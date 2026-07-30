<?php

namespace App\Http\Controllers;

use App\Actions\CreateEquipmentAction;
use App\Actions\UpdateEquipmentAction;
use App\DTOs\StoreEquipmentData;
use App\DTOs\UpdateEquipmentData;
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Models\User;
use App\Repositories\Contracts\EquipmentRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminEquipmentController extends Controller
{
    public function __construct(
        private readonly EquipmentRepositoryInterface $equipmentRepository,
        private readonly CreateEquipmentAction $createEquipmentAction,
        private readonly UpdateEquipmentAction $updateEquipmentAction,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        return response()->json(['equipments' => $this->equipmentRepository->getAll()]);
    }

    public function store(StoreEquipmentRequest $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $data = StoreEquipmentData::fromRequest($request->validated());
        $equipment = $this->createEquipmentAction->execute($data);

        return response()->json(['message' => 'Equipamento criado', 'equipment' => $equipment], 201);
    }

    public function update(UpdateEquipmentRequest $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $equipment = $this->equipmentRepository->findById($id);
        if (! $equipment) {
            return response()->json(['message' => 'Equipamento não encontrado'], 404);
        }

        $data = UpdateEquipmentData::fromRequest($request->validated());
        $equipment = $this->updateEquipmentAction->execute($equipment, $data);

        return response()->json(['message' => 'Equipamento atualizado', 'equipment' => $equipment]);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $equipment = $this->equipmentRepository->findById($id);
        if (! $equipment) {
            return response()->json(['message' => 'Equipamento não encontrado'], 404);
        }

        $this->equipmentRepository->delete($equipment);

        return response()->json(['message' => 'Equipamento eliminado']);
    }
}
