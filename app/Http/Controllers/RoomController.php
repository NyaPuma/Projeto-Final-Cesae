<?php

namespace App\Http\Controllers;

use App\Actions\CreateRoomAction;
use App\Actions\UpdateRoomAction;
use App\DTOs\StoreRoomData;
use App\DTOs\UpdateRoomData;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Repositories\Contracts\RoomRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct(
        private readonly RoomRepositoryInterface $roomRepository,
        private readonly CreateRoomAction $createRoomAction,
        private readonly UpdateRoomAction $updateRoomAction,
    ) {}

    public function indexRoom(Request $request): JsonResponse
    {
        return response()->json(['rooms' => $this->roomRepository->getAll()]);
    }

    public function storeRoom(StoreRoomRequest $request): JsonResponse
    {
        $data = StoreRoomData::fromRequest($request->validated());
        $room = $this->createRoomAction->execute($data);

        return response()->json(['room' => $room], 201);
    }

    public function updateRoom(UpdateRoomRequest $request, int $id): JsonResponse
    {
        $room = $this->roomRepository->findById($id);
        if (! $room) {
            return $this->jsonNotFound('Sala não encontrada');
        }

        $data = UpdateRoomData::fromRequest($request->validated());
        $room = $this->updateRoomAction->execute($room, $data);

        return response()->json(['room' => $room]);
    }

    public function inactivateRoom(Request $request, int $id): JsonResponse
    {
        $room = $this->roomRepository->findById($id);
        if (! $room) {
            return $this->jsonNotFound('Sala não encontrada');
        }

        $this->roomRepository->inactivate($room);

        return response()->json(['message' => 'Sala inativada com sucesso']);
    }
}
