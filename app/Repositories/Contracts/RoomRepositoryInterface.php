<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Room;
use Illuminate\Pagination\LengthAwarePaginator;

interface RoomRepositoryInterface
{
    /**
     * Find a room by its ID.
     */
    public function findById(int $id): ?Room;

    /**
     * Return a paginated list of rooms.
     *
     * @param  array<int, string>  $relations
     * @return LengthAwarePaginator<Room>
     */
    public function getAll(array $relations = []): LengthAwarePaginator;

    /**
     * Return all active rooms.
     *
     * @return array<int, Room>
     */
    public function getActive(): array;

    /**
     * Create a new room record.
     *
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Room;

    /**
     * Update an existing room.
     *
     * @param  array<string, mixed>  $data
     */
    public function update(Room $room, array $data): bool;

    /**
     * Inactivate a room.
     */
    public function inactivate(Room $room): bool;
}
