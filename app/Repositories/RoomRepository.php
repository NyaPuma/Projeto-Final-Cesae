<?php

namespace App\Repositories;

use App\Models\Room;
use App\Repositories\Contracts\RoomRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class RoomRepository implements RoomRepositoryInterface
{
    public function findById(int $id): ?Room
    {
        return Room::find($id);
    }

    public function getAll(array $relations = []): LengthAwarePaginator
    {
        return Room::with($relations)->latest()->paginate(15);
    }

    public function getActive(): array
    {
        return Room::where('active', true)
            ->orderBy('location')
            ->orderBy('name')
            ->get(['id', 'name', 'code', 'location'])
            ->toArray();
    }

    public function create(array $data): Room
    {
        return Room::create($data);
    }

    public function update(Room $room, array $data): bool
    {
        return $room->update($data);
    }

    public function inactivate(Room $room): bool
    {
        return $room->update(['active' => false]);
    }
}
