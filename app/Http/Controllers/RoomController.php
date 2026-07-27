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
     * Lista todas as salas registadas com a contagem real de equipamentos e avarias.
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
            // Força o carregamento da contagem direta da relação equipments
            $query = Room::query()->withCount('equipments');

            // 1. Pesquisa por nome
            if ($request->filled('q')) {
                $query->where('name', 'like', '%' . $request->q . '%');
            }

            // 2. Pesquisa por edifício / localização
            if ($request->filled('building')) {
                $buildingSearch = $request->building;
                $query->where(function ($q) use ($buildingSearch) {
                    $q->where('building', 'like', '%' . $buildingSearch . '%')
                      ->orWhere('location', 'like', '%' . $buildingSearch . '%');
                });
            }

            $rooms = $query->orderBy('name')->paginate(15);

            // 3. Cruzamento seguro de dados diretamente na coleção paginada
            $rooms->getCollection()->transform(function ($room) {
                // Utiliza a contagem gerada pelo withCount ou calcula diretamente se vier nulo
                $count = $room->equipments_count ?? $room->equipments()->count();
                $location = $room->location ?? $room->building ?? '-';

                $room->equipment_count = $count;
                $room->equipments_count = $count;
                $room->building = $location;
                $room->active_tickets_count = 0;

                // Contagem de avarias ativas se a relação existir
                if (method_exists($room, 'tickets')) {
                    $room->active_tickets_count = $room->tickets()
                        ->whereIn('status', ['aberto', 'aberta', 'em curso', 'pendente orçamento'])
                        ->count();
                }

                return $room;
            });

            return response()->json(['rooms' => $rooms]);

        } catch (\Throwable $e) {
            Log::error('Erro ao carregar salas: ' . $e->getMessage());

            $rooms = Room::withCount('equipments')->orderBy('name')->paginate(15);
            $rooms->getCollection()->transform(function ($room) {
                $count = $room->equipments_count ?? $room->equipments()->count();
                $room->equipment_count = $count;
                $room->equipments_count = $count;
                $room->building = $room->location ?? $room->building ?? '-';
                $room->active_tickets_count = 0;
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