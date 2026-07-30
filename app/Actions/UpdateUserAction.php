<?php

namespace App\Actions;

use App\DTOs\UpdateUserData;
use App\Models\User;
use Illuminate\Support\Facades\DB;

final readonly class UpdateUserAction
{
    public function execute(User $user, UpdateUserData $data): User
    {
        return DB::transaction(function () use ($user, $data) {
            $attributes = [
                'name' => $data->name ? trim($data->name) : $user->name,
                'email' => $data->email ? trim(strtolower($data->email)) : $user->email,
                'active' => $data->active ?? $user->active,
            ];

            if ($data->profileId !== null) {
                $attributes['profile_id'] = $data->profileId;
            }

            $user->update($attributes);

            // Exemplo de disparo de evento no futuro:
            // UserUpdated::dispatch($user);

            return $user->load('profile');
        });
    }
}
