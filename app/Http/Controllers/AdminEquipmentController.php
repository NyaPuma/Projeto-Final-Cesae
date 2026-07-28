<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Models\Equipment;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminEquipmentController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        return response()->json(Equipment::all());
    }

    public function store(StoreEquipmentRequest $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $equipment = Equipment::create($request->validated());

        return response()->json(['message' => 'Equipamento criado', 'equipment' => $equipment], 201);
    }

    public function update(UpdateEquipmentRequest $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $equipment = Equipment::findOrFail($id);
        $equipment->update($request->validated());

        return response()->json(['message' => 'Equipamento atualizado', 'equipment' => $equipment]);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        Equipment::findOrFail($id)->delete();

        return response()->json(['message' => 'Equipamento eliminado']);
    }
}
