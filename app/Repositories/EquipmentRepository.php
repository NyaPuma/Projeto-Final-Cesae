<?php

namespace App\Repositories;

use App\Models\Equipment;
use App\Repositories\Contracts\EquipmentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class EquipmentRepository implements EquipmentRepositoryInterface
{
    public function findById(int $id): ?Equipment
    {
        return Equipment::find($id);
    }

    public function getAll(array $relations = []): LengthAwarePaginator
    {
        return Equipment::with($relations)->latest()->paginate(15);
    }

    public function create(array $data): Equipment
    {
        return Equipment::create($data);
    }

    public function update(Equipment $equipment, array $data): bool
    {
        return $equipment->update($data);
    }

    public function delete(Equipment $equipment): bool
    {
        return $equipment->delete();
    }
}
