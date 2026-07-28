<?php

namespace App\Repositories\Contracts;

use App\Models\Equipment;
use Illuminate\Pagination\LengthAwarePaginator;

interface EquipmentRepositoryInterface
{
    public function findById(int $id): ?Equipment;

    public function getAll(array $relations = []): LengthAwarePaginator;

    public function create(array $data): Equipment;

    public function update(Equipment $equipment, array $data): bool;

    public function delete(Equipment $equipment): bool;
}
