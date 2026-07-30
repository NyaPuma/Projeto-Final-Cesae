<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Room;
use Illuminate\Pagination\LengthAwarePaginator;

interface RoomRepositoryInterface
{
    /**
     * Encontra uma sala pelo seu ID.
     *
     * @param int $id
     * @return Room|null
     */
    public function findById(int $id): ?Room;

    /**
     * Retorna uma listagem paginada de salas.
     *
     * @param array<int, string> $relations
     * @return LengthAwarePaginator<Room>
     */
    public function getAll(array $relations = []): LengthAwarePaginator;

    /**
     * Retorna todas as salas ativas.
     *
     * @return array<int, Room>
     */
    public function getActive(): array;

    /**
     * Cria um novo registo de sala.
     *
     * @param array<string, mixed> $data
     * @return Room
     */
    public function create(array $data): Room;

    /**
     * Atualiza uma sala existente.
     *
     * @param Room $room
     * @param array<string, mixed> $data
     * @return bool
     */
    public function update(Room $room, array $data): bool;

    /**
     * Inativa uma sala.
     *
     * @param Room $room
     * @return bool
     */
    public function inactivate(Room $room): bool;
}
