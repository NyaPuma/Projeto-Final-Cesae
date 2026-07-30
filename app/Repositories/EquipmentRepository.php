<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Equipment;
use App\Repositories\Contracts\EquipmentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class EquipmentRepository implements EquipmentRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function findById(int $id): ?Equipment
    {
        return Equipment::find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getAll(array $relations = []): LengthAwarePaginator
    {
        return Equipment::with($relations)->latest()->paginate(15);
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $data): Equipment
    {
        return Equipment::create($data);
    }

    /**
     * {@inheritDoc}
     */
    public function update(Equipment $equipment, array $data): bool
    {
        return $equipment->update($data);
    }

    /**
     * {@inheritDoc}
     */
    public function delete(Equipment $equipment): bool
    {
        return $equipment->delete();
    }
}
