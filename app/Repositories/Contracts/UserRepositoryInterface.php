<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    /**
     * Encontra um utilizador pelo seu ID.
     *
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User;

    /**
     * Encontra um utilizador pelo seu endereço de e-mail.
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;

    /**
     * Retorna uma listagem paginada de utilizadores.
     *
     * @param array<int, string> $relations
     * @return LengthAwarePaginator<User>
     */
    public function getAll(array $relations = []): LengthAwarePaginator;

    /**
     * Retorna todos os técnicos ativos.
     *
     * @return array<int, User>
     */
    public function getActiveTechnicians(): array;

    /**
     * Retorna todos os administradores.
     *
     * @return array<int, User>
     */
    public function getAdmins(): array;

    /**
     * Cria um novo utilizador.
     *
     * @param array<string, mixed> $data
     * @return User
     */
    public function create(array $data): User;

    /**
     * Atualiza um utilizador existente.
     *
     * @param User $user
     * @param array<string, mixed> $data
     * @return bool
     */
    public function update(User $user, array $data): bool;

    /**
     * Inativa um utilizador.
     *
     * @param User $user
     * @return bool
     */
    public function inactivate(User $user): bool;
}
