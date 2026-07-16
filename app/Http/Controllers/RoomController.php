<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use OpenApi\Attributes as OA;

class RoomController extends Controller
{
     /**
     * Lista todas as salas registadas.
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
        // A listagem de salas também é paginada para manter o backoffice fluido.
        return response()->json(['rooms' => Room::orderBy('name')->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createRoom()
    {
        //
        return view('rooms.create');
    }

    /**
     * Cria uma nova sala de trabalho.
     */
    #[OA\Post(
        path: '/admin/rooms',
        tags: ['Admin'],
        summary: 'Criar sala',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        responses: [
            new OA\Response(response: 201, description: 'Sala criada'),
            new OA\Response(response: 422, description: 'Erro de validação')
        ]
    )]
    public function storeRoom(Request $request)
    {
        $data = $request->only(['name', 'location']);
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // A sala é criada ativa para ficar disponível imediatamente para associação a equipamentos.
        $room = Room::create([
            'name' => $data['name'],
            'location' => $data['location'] ?? null,
            'active' => true,
        ]);

        return response()->json(['room' => $room], 201);
    }

    /**
     * Display the specified resource.
     */
    public function showRoom(Room $room)
    {
        //
        return view('rooms.show', compact('room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editRoom(Room $room)
    {
        //
        return view('rooms.edit', compact('room'));
    }

   /**
     * Atualiza os detalhes de uma sala.
     */
    #[OA\Patch(
        path: '/admin/rooms/{id}',
        tags: ['Admin'],
        summary: 'Atualizar sala',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Sala atualizada'),
            new OA\Response(response: 404, description: 'Sala não encontrada'),
            new OA\Response(response: 422, description: 'Erro de validação')
        ]
    )]
    public function updateRoom(Request $request, int $id)
    {
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

        // Atualizamos apenas o que foi validado para evitar sobrescrever campos com valores vazios.
        $room->update($validator->validated());

        return response()->json(['room' => $room]);
    }

   /**
     * Inativa uma sala (Gestão lógica / Soft management).
     */
    #[OA\Patch(
        path: '/admin/rooms/{id}/inactive',
        tags: ['Admin'],
        summary: 'Inativar sala',
        security: [['X-Auth-Token' => []], ['BearerAuth' => []]],
        parameters: [
            new OA\Parameter(name: 'id', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))
        ],
        responses: [
            new OA\Response(response: 200, description: 'Sala inativada'),
            new OA\Response(response: 404, description: 'Sala não encontrada')
        ]
    )]
    public function inactivateRoom(Request $request, int $id)
    {
        $room = Room::find($id);
        if (!$room) {
            return response()->json(['message' => 'Sala não encontrada'], 404);
        }

        // Inativar é preferível a apagar, porque preserva referências históricas existentes.
        $room->active = false;
        $room->save();

        return response()->json(['message' => 'Sala inativada com sucesso']);
    }








}
