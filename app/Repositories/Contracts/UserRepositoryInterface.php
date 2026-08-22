<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    /**
     * Find a user by their ID.
     *
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User;

    /**
     * Find a user by their email address.
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;

    /**
     * Return a paginated list of users.
     *
     * @param array<int, string> $relations
     * @return LengthAwarePaginator<User>
     */
    public function getAll(array $relations = []): LengthAwarePaginator;

    /**
     * Return all active technicians.
     *
     * @return array<int, User>
     */
    public function getActiveTechnicians(): array;

    /**
     * Return all administrators.
     *
     * @return array<int, User>
     */
    public function getAdmins(): array;

    /**
     * Create a new user.
     *
     * @param array<string, mixed> $data
     * @return User
     */
    public function create(array $data): User;

    /**
     * Update an existing user.
     *
     * @param User $user
     * @param array<string, mixed> $data
     * @return bool
     */
    public function update(User $user, array $data): bool;

    /**
     * Inactivate a user.
     *
     * @param User $user
     * @return bool
     */
    public function inactivate(User $user): bool;

    /**
     * Delete (soft delete) a user.
     *
     * @param User $user
     * @return bool
     */
    public function delete(User $user): bool;
}
