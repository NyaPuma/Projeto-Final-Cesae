<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

final class UserRepository implements UserRepositoryInterface
{
    public function findById(int $id): ?User
    {
        return User::find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return User::where('email', strtolower($email))->first();
    }

    public function getAll(array $relations = []): LengthAwarePaginator
    {
        return User::with($relations)->latest()->paginate(15);
    }

    public function getActiveTechnicians(): array
    {
        return User::whereHas('profile', fn ($q) => $q->where('name', User::ROLE_TECHNICIAN))
            ->where('active', true)
            ->get(['id', 'name'])
            ->toArray();
    }

    public function getAdmins(): array
    {
        return User::whereHas('profile', fn ($q) => $q->where('name', User::ROLE_ADMIN))
            ->get(['id', 'name'])
            ->toArray();
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }

    public function inactivate(User $user): bool
    {
        return $user->update(['active' => false]);
    }
}
