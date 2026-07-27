<?php

namespace App\Http\Controllers;

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

        $equipments = Equipment::all();

        return response()->json($equipments);
    }

    public function store(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'room_id' => 'required|exists:rooms,id',
            'status' => 'required|string|in:active,inactive,maintenance',
        ]);

        $equipment = Equipment::create($validated);

        return response()->json(['message' => 'Equipamento criado', 'equipment' => $equipment], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $equipment = Equipment::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'room_id' => 'sometimes|exists:rooms,id',
            'status' => 'sometimes|string|in:active,inactive,maintenance',
        ]);

        $equipment->update($validated);

        return response()->json(['message' => 'Equipamento atualizado', 'equipment' => $equipment]);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $equipment = Equipment::findOrFail($id);
        $equipment->delete();

        return response()->json(['message' => 'Equipamento eliminado']);
    }
}
