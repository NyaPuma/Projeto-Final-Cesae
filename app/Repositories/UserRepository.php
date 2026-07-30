<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class UserRepository implements UserRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    /**
     * {@inheritDoc}
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', strtolower($email))->first();
    }

    /**
     * {@inheritDoc}
     */
    public function getAll(array $relations = []): LengthAwarePaginator
    {
        return User::with($relations)->latest()->paginate(15);
    }

    /**
     * {@inheritDoc}
     */
    public function getActiveTechnicians(): array
    {
        return User::whereHas('profile', fn ($q) => $q->where('name', UserRoleEnum::Technician->value))
            ->where('active', true)
            ->get(['id', 'name'])
            ->toArray();
    }

    /**
     * {@inheritDoc}
     */
    public function getAdmins(): array
    {
        return User::whereHas('profile', fn ($q) => $q->where('name', UserRoleEnum::Admin->value))
            ->get(['id', 'name'])
            ->toArray();
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * {@inheritDoc}
     */
    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }

    /**
     * {@inheritDoc}
     */
    public function inactivate(User $user): bool
    {
        return $user->update(['active' => false]);
    }
}
