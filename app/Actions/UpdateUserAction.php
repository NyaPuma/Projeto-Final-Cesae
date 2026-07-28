<?php

namespace App\Actions;

use App\DTOs\UpdateUserData;
use App\Models\User;

final readonly class UpdateUserAction
{
    public function execute(User $user, UpdateUserData $data): User
    {
        $user->update([
            'name' => $data->name,
            'email' => strtolower($data->email),
            'active' => $data->active ?? $user->active,
        ]);

        if ($data->profileId) {
            $user->profile_id = $data->profileId;
            $user->save();
        }

        return $user;
    }
}
