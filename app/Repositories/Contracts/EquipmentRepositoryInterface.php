<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Equipment;
use Illuminate\Pagination\LengthAwarePaginator;

interface EquipmentRepositoryInterface
{
    /**
     * Find an equipment by its ID.
     *
     * @param int $id
     * @return Equipment|null
     */
    public function findById(int $id): ?Equipment;

    /**
     * Return a paginated list of equipment.
     *
     * @param array<int, string> $relations
     * @return LengthAwarePaginator<Equipment>
     */
    public function getAll(array $relations = []): LengthAwarePaginator;

    /**
     * Create a new equipment record.
     *
     * @param array<string, mixed> $data
     * @return Equipment
     */
    public function create(array $data): Equipment;

    /**
     * Update an existing equipment.
     *
     * @param Equipment $equipment
     * @param array<string, mixed> $data
     * @return bool
     */
    public function update(Equipment $equipment, array $data): bool;

    /**
     * Delete an equipment from the database.
     *
     * @param Equipment $equipment
     * @return bool
     */
    public function delete(Equipment $equipment): bool;
}
