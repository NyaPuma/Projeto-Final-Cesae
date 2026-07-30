<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\Equipment;
use Illuminate\Pagination\LengthAwarePaginator;

interface EquipmentRepositoryInterface
{
    /**
     * Encontra um equipamento pelo seu ID.
     *
     * @param int $id
     * @return Equipment|null
     */
    public function findById(int $id): ?Equipment;

    /**
     * Retorna uma listagem paginada de equipamentos.
     *
     * @param array<int, string> $relations
     * @return LengthAwarePaginator<Equipment>
     */
    public function getAll(array $relations = []): LengthAwarePaginator;

    /**
     * Cria um novo registo de equipamento.
     *
     * @param array<string, mixed> $data
     * @return Equipment
     */
    public function create(array $data): Equipment;

    /**
     * Atualiza um equipamento existente.
     *
     * @param Equipment $equipment
     * @param array<string, mixed> $data
     * @return bool
     */
    public function update(Equipment $equipment, array $data): bool;

    /**
     * Elimina um equipamento da base de dados.
     *
     * @param Equipment $equipment
     * @return bool
     */
    public function delete(Equipment $equipment): bool;
}
