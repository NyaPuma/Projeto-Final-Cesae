<?php

namespace App\Actions;

use App\DTOs\StoreUserData;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final readonly class CreateUserAction
{
    public function __construct(
        private UserService $userService,
    ) {}

    public function execute(StoreUserData $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => trim($data->name),
                'email' => trim(strtolower($data->email)),
                'password' => Hash::make($data->password),
                'profile_id' => $data->profileId,
                'active' => $data->active ?? true,
            ]);

            return $user->load('profile');
        });
    }
}
