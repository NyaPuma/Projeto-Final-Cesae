<?php

namespace App\Repositories\Contracts;

use App\Models\Room;
use Illuminate\Pagination\LengthAwarePaginator;

interface RoomRepositoryInterface
{
    public function findById(int $id): ?Room;

    public function getAll(array $relations = []): LengthAwarePaginator;

    public function getActive(): array;

    public function create(array $data): Room;

    public function update(Room $room, array $data): bool;

    public function inactivate(Room $room): bool;
}
