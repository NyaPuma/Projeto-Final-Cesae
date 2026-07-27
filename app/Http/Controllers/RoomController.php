<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use OpenApi\Attributes as OA;

class RoomController extends Controller
{
    /**
     * Lista todas as salas registadas com a contagem de equipamentos e avarias.
     */
    #[OA\Get(
        path: '/admin/rooms',
        tags: ['Admin'],
        summary: 'Listar salas',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [new OA\Response(response: 200, description: 'Lista de salas')]
    )]
    public function indexRoom(Request $request)
    {
        try {
            $query = Room::query();

            // 1. Contagem de equipamentos de forma segura
            if (Schema::hasTable('equipments') && Schema::hasColumn('equipments', 'room_id')) {
                if (method_exists(Room::class, 'equipments')) {
                    $query->withCount('equipments');
                } elseif (method_exists(Room::class, 'equipment')) {
                    $query->withCount('equipment');
                }
            }

            // 2. Contagem de avarias ativas se existir a relação
            if (Schema::hasTable('tickets') && Schema::hasColumn('tickets', 'room_id')) {
                if (method_exists(Room::class, 'tickets')) {
                    $query->withCount(['tickets as active_tickets_count' => function ($q) {
                        $q->whereIn('status', ['aberto', 'aberta', 'em curso', 'pendente orçamento']);
                    }]);
                }
            }

            // 3. Pesquisa por nome
            if ($request->filled('q')) {
                $query->where('name', 'like', '%' . $request->q . '%');
            }

            // 4. Pesquisa por edifício / localização
            if ($request->filled('building')) {
                $buildingSearch = $request->building;
                $hasBuilding = Schema::hasColumn('rooms', 'building');
                $hasLocation = Schema::hasColumn('rooms', 'location');

                $query->where(function ($q) use ($buildingSearch, $hasBuilding, $hasLocation) {
                    if ($hasBuilding && $hasLocation) {
                        $q->where('building', 'like', '%' . $buildingSearch . '%')
                          ->orWhere('location', 'like', '%' . $buildingSearch . '%');
                    } elseif ($hasBuilding) {
                        $q->where('building', 'like', '%' . $buildingSearch . '%');
                    } elseif ($hasLocation) {
                        $q->where('location', 'like', '%' . $buildingSearch . '%');
                    } else {
                        $q->where('name', 'like', '%' . $buildingSearch . '%');
                    }
                });
            }

            $rooms = $query->orderBy('name')->paginate(15);

            // 5. Injeta de forma explícita no JSON
            $rooms->getCollection()->transform(function ($room) {
                $count = $room->equipments_count ?? $room->equipment_count ?? 0;
                $location = $room->location ?? $room->building ?? '-';

                $room->setAttribute('equipment_count', $count);
                $room->setAttribute('equipments_count', $count);
                $room->setAttribute('building', $location);
                $room->setAttribute('active_tickets_count', $room->active_tickets_count ?? 0);

                return $room;
            });

            return response()->json(['rooms' => $rooms]);

        } catch (\Throwable $e) {
            Log::error('Erro ao carregar salas: ' . $e->getMessage());

            // Fallback de emergência para não bloquear o front-end
            $rooms = Room::orderBy('name')->paginate(15);
            $rooms->getCollection()->transform(function ($room) {
                $room->setAttribute('equipment_count', 0);
                $room->setAttribute('equipments_count', 0);
                $room->setAttribute('building', $room->location ?? $room->building ?? '-');
                $room->setAttribute('active_tickets_count', 0);
                return $room;
            });

            return response()->json(['rooms' => $rooms]);
        }
    }

    public function createRoom()
    {
        return view('rooms.create');
    }

    #[OA\Post(
        path: '/admin/rooms',
        tags: ['Admin'],
        summary: 'Criar sala',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 201, description: 'Sala criada'),
            new OA\Response(response: 422, description: 'Erro de validação'),
        ]
    )]
    public function storeRoom(Request $request)
    {
        $data = $request->only(['name', 'location', 'building']);
        $validator = Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $locationValue = $data['building'] ?? $data['location'] ?? null;
        $payload = ['name' => $data['name'], 'active' => true];

        if (Schema::hasColumn('rooms', 'building')) {
            $payload['building'] = $locationValue;
        }
        if (Schema::hasColumn('rooms', 'location')) {
            $payload['location'] = $locationValue;
        }

        $room = Room::create($payload);

        return response()->json(['room' => $room], 201);
    }

    public function showRoom(Room $room)
    {
        return view('rooms.show', compact('room'));
    }

    public function editRoom(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    #[OA\Patch(
        path: '/admin/rooms/{id}',
        tags: ['Admin'],
        summary: 'Atualizar sala',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Sala atualizada'),
            new OA\Response(response: 404, description: 'Sala não encontrada'),
            new OA\Response(response: 422, description: 'Erro de validação'),
        ]
    )]
    public function updateRoom(Request $request, int $id)
    {
        $room = Room::find($id);
        if (! $room) {
            return response()->json(['message' => 'Sala não encontrada'], 404);
        }

        $data = $request->only(['name', 'location', 'building']);
        $validator = Validator::make($data, [
            'name'     => ['sometimes', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $updatePayload = [];

        if (isset($validated['name'])) {
            $updatePayload['name'] = $validated['name'];
        }

        $locationValue = $validated['building'] ?? $validated['location'] ?? null;
        if ($locationValue !== null) {
            if (Schema::hasColumn('rooms', 'building')) {
                $updatePayload['building'] = $locationValue;
            }
            if (Schema::hasColumn('rooms', 'location')) {
                $updatePayload['location'] = $locationValue;
            }
        }

        $room->update($updatePayload);

        return response()->json(['room' => $room]);
    }

    #[OA\Patch(
        path: '/admin/rooms/{id}/inactive',
        tags: ['Admin'],
        summary: 'Inativar sala',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer')),
        ],
        responses: [
            new OA\Response(response: 200, description: 'Sala inativada'),
            new OA\Response(response: 404, description: 'Sala não encontrada'),
        ]
    )]
    public function inactivateRoom(Request $request, int $id)
    {
        $room = Room::find($id);
        if (! $room) {
            return response()->json(['message' => 'Sala não encontrada'], 404);
        }

        $room->active = false;
        $room->save();

        return response()->json(['message' => 'Sala inativada com sucesso']);
    }
}