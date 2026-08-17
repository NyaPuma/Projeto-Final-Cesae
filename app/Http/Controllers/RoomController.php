<?php

namespace App\Http\Controllers;

use App\Actions\CreateRoomAction;
use App\Actions\UpdateRoomAction;
use App\DTOs\StoreRoomData;
use App\DTOs\UpdateRoomData;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Resources\RoomResource;
use App\Models\Room;
use App\Repositories\Contracts\RoomRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class RoomController extends Controller
{
    public function __construct(
        private readonly RoomRepositoryInterface $roomRepository,
        private readonly CreateRoomAction $createRoomAction,
        private readonly UpdateRoomAction $updateRoomAction,
    ) {}

    /**
     * Lista todas as salas registadas no sistema.
     */
    public function indexRoom(Request $request): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('viewAny', Room::class);

        // 2. Procura de salas através do repositório
        $rooms = $this->roomRepository->getAll();

        return response()->json([
            'rooms' => RoomResource::collection($rooms),
        ]);
    }

    /**
     * Cria uma nova sala no sistema.
     */
    public function storeRoom(StoreRoomRequest $request): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('create', Room::class);

        // 2. Executa DTO e Action para criação
        $data = StoreRoomData::fromRequest($request->validated());
        $room = $this->createRoomAction->execute($data);

        return response()->json([
            'message' => __('messages.Sala criada com sucesso.'),
            'room' => new RoomResource($room),
        ], 201);
    }

    /**
     * Atualiza os dados de uma sala existente.
     */
    public function updateRoom(UpdateRoomRequest $request, Room $room): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('update', $room);

        // 2. Executa DTO e Action para atualização
        $data = UpdateRoomData::fromRequest($request->validated());
        $updatedRoom = $this->updateRoomAction->execute($room, $data);

        return response()->json([
            'message' => __('messages.Sala atualizada com sucesso.'),
            'room' => new RoomResource($updatedRoom),
        ]);
    }

    /**
     * Inativa uma sala existente no sistema.
     */
    public function inactivateRoom(Request $request, Room $room): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('update', $room);

        // 2. Inativação via Repositório
        $this->roomRepository->inactivate($room);

        return response()->json([
            'message' => __('messages.Sala inativada com sucesso.'),
        ]);
    }
}
