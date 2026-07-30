<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;

    public function findByEmail(string $email): ?User;

    public function getAll(array $relations = []): LengthAwarePaginator;

    public function getActiveTechnicians(): array;

    public function getAdmins(): array;

    public function create(array $data): User;

    public function update(User $user, array $data): bool;

    public function inactivate(User $user): bool;
}
