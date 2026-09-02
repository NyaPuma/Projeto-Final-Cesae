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
     * Lists all rooms registered in the system.
     */
    public function indexRoom(Request $request): JsonResponse
    {
        // 1. Authorization via Policy
        $this->authorize('viewAny', Room::class);

        // 2. Search for rooms via the repository
        $rooms = $this->roomRepository->getAll(withCounts: ['equipments']);

        return response()->json([
            'rooms' => RoomResource::collection($rooms),
        ]);
    }

    /**
     * Creates a new room in the system.
     */
    public function storeRoom(StoreRoomRequest $request): JsonResponse
    {
        // 1. Authorization via Policy
        $this->authorize('create', Room::class);

        // 2. Execute DTO and Action for creation
        $data = StoreRoomData::fromRequest($request->validated());
        $room = $this->createRoomAction->execute($data);

        return response()->json([
            'message' => __('messages.Sala criada com sucesso.'),
            'room' => new RoomResource($room),
        ], 201);
    }

    /**
     * Updates an existing room's data.
     */
    public function updateRoom(UpdateRoomRequest $request, Room $room): JsonResponse
    {
        // 1. Authorization via Policy
        $this->authorize('update', $room);

        // 2. Execute DTO and Action for update
        $data = UpdateRoomData::fromRequest($request->validated());
        $updatedRoom = $this->updateRoomAction->execute($room, $data);

        return response()->json([
            'message' => __('messages.Sala atualizada com sucesso.'),
            'room' => new RoomResource($updatedRoom),
        ]);
    }

    /**
     * Deactivates an existing room in the system.
     */
    public function inactivateRoom(Request $request, Room $room): JsonResponse
    {
        // 1. Authorization via Policy
        $this->authorize('update', $room);

        // 2. Deactivation via Repository
        $this->roomRepository->inactivate($room);

        return response()->json([
            'message' => __('messages.Sala inativada com sucesso.'),
        ]);
    }
}
