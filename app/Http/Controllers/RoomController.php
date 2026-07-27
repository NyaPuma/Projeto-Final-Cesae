<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function indexRoom(Request $request): JsonResponse
    {
        return response()->json(['rooms' => Room::orderBy('name')->paginate(15)]);
    }

    public function createRoom()
    {
        return view('rooms.create');
    }

    public function storeRoom(StoreRoomRequest $request): JsonResponse
    {
        $room = Room::create([
            'name' => $request->name,
            'location' => $request->location,
            'active' => true,
        ]);

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

    public function updateRoom(UpdateRoomRequest $request, int $id): JsonResponse
    {
        $room = Room::find($id);
        if (! $room) {
            return $this->jsonNotFound('Sala não encontrada');
        }

        $room->update($request->validated());

        return response()->json(['room' => $room]);
    }

    public function inactivateRoom(Request $request, int $id): JsonResponse
    {
        $room = Room::find($id);
        if (! $room) {
            return $this->jsonNotFound('Sala não encontrada');
        }

        $room->active = false;
        $room->save();

        return response()->json(['message' => 'Sala inativada com sucesso']);
    }
}
