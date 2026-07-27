<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EquipmentController extends Controller
{
    /**
     * Lista todos os equipamentos com as respetivas salas e categorias.
     */
    public function index(Request $request)
    {
        $query = Equipment::with(['room', 'category']);

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('serial', 'like', '%' . $request->q . '%');
            });
        }

        if ($request->has('status') && $request->status !== '') {
            $isActive = in_array($request->status, ['1', 'true', 'active', 1], true);
            $query->where('active', $isActive);
        }

        $equipments = $query->orderBy('name')->paginate(15);

        return response()->json([
            'equipments' => $equipments
        ]);
    }

    /**
     * Guarda um novo equipamento com associação de sala.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => ['required', 'string', 'max:255'],
            'serial'      => ['nullable', 'string', 'max:255'],
            'room_id'     => ['nullable', 'exists:rooms,id'],
            'category_id' => ['nullable', 'exists:equipment_categories,id'],
            'active'      => ['nullable'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $data['active'] = filter_var($request->input('active', true), FILTER_VALIDATE_BOOLEAN);

        $equipment = Equipment::create($data);
        $equipment->load(['room', 'category']);

        return response()->json(['equipment' => $equipment], 201);
    }

    /**
     * Exibe um equipamento específico.
     */
    public function show(Equipment $equipment)
    {
        $equipment->load(['room', 'category']);
        return response()->json(['equipment' => $equipment]);
    }

    /**
     * Atualiza os dados de um equipamento e a sua sala/localização.
     */
    public function update(Request $request, $id)
    {
        $equipment = Equipment::find($id);
        if (!$equipment) {
            return response()->json(['message' => 'Equipamento não encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name'        => ['sometimes', 'required', 'string', 'max:255'],
            'serial'      => ['nullable', 'string', 'max:255'],
            'room_id'     => ['nullable', 'exists:rooms,id'],
            'category_id' => ['nullable', 'exists:equipment_categories,id'],
            'active'      => ['nullable'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        if ($request->has('active')) {
            $data['active'] = filter_var($request->input('active'), FILTER_VALIDATE_BOOLEAN);
        }

        $equipment->update($data);
        $equipment->load(['room', 'category']);

        return response()->json(['equipment' => $equipment]);
    }

    /**
     * Elimina / Inativa um equipamento.
     */
    public function destroy($id)
    {
        $equipment = Equipment::find($id);
        if (!$equipment) {
            return response()->json(['message' => 'Equipamento não encontrado'], 404);
        }

        $equipment->delete();
        return response()->json(['message' => 'Equipamento eliminado com sucesso']);
    }
}