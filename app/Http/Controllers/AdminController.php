<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function users(Request $request)
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        return response()->json(['users' => User::all()]);
    }

    public function inactivateUser(Request $request, int $id)
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Utilizador não encontrado'], 404);
        }

        if ($user->isAdmin()) {
            return response()->json(['message' => 'Não é possível inativar um administrador'], 422);
        }

        $user->active = false;
        $user->save();

        return response()->json(['message' => 'Utilizador inativado com sucesso']);
    }

    public function equipments(Request $request)
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        return response()->json(['equipments' => Equipment::with('room')->get()]);
    }

    public function storeEquipment(Request $request)
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $data = $request->only(['name', 'serial', 'room_id']);
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'serial' => ['required', 'string', 'max:255', 'unique:equipments,serial'],
            'room_id' => ['nullable', 'integer', 'exists:rooms,id'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $equipment = Equipment::create([
            'name' => $data['name'],
            'serial' => $data['serial'],
            'room_id' => $data['room_id'] ?? null,
            'active' => true,
        ]);

        return response()->json(['equipment' => $equipment], 201);
    }

    public function updateEquipment(Request $request, int $id)
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $equipment = Equipment::find($id);
        if (!$equipment) {
            return response()->json(['message' => 'Equipamento não encontrado'], 404);
        }

        $data = $request->only(['name', 'serial', 'room_id', 'active']);
        $validator = Validator::make($data, [
            'name' => ['sometimes', 'string', 'max:255'],
            'serial' => ['sometimes', 'string', 'max:255', 'unique:equipments,serial,'.$id],
            'room_id' => ['nullable', 'integer', 'exists:rooms,id'],
            'active' => ['sometimes', 'boolean'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $equipment->update($data);

        return response()->json(['equipment' => $equipment]);
    }

    public function destroyEquipment(Request $request, int $id)
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $equipment = Equipment::find($id);
        if (!$equipment) {
            return response()->json(['message' => 'Equipamento não encontrado'], 404);
        }

        $equipment->delete();

        return response()->json(['message' => 'Equipamento eliminado']);
    }

    public function rooms(Request $request)
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        return response()->json(['rooms' => Room::all()]);
    }

    public function storeRoom(Request $request)
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $data = $request->only(['name', 'location']);
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $room = Room::create([
            'name' => $data['name'],
            'location' => $data['location'] ?? null,
            'active' => true,
        ]);

        return response()->json(['room' => $room], 201);
    }

    public function updateRoom(Request $request, int $id)
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $room = Room::find($id);
        if (!$room) {
            return response()->json(['message' => 'Sala não encontrada'], 404);
        }

        $data = $request->only(['name', 'location']);
        $validator = Validator::make($data, [
            'name' => ['sometimes', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $room->update($data);

        return response()->json(['room' => $room]);
    }

    public function inactivateRoom(Request $request, int $id)
    {
        $admin = $this->authenticatedUser($request);
        $this->requireRole($admin, [User::ROLE_ADMIN]);

        $room = Room::find($id);
        if (!$room) {
            return response()->json(['message' => 'Sala não encontrada'], 404);
        }

        $room->active = false;
        $room->save();

        return response()->json(['message' => 'Sala inativada com sucesso']);
    }
}
