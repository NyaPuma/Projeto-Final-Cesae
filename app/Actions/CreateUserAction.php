<?php

namespace App\Actions;

use App\DTOs\StoreUserData;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

final readonly class CreateUserAction
{
    public function __construct(
        private readonly UserService $userService,
    ) {}

    public function execute(StoreUserData $data): User
    {
        $user = User::create([
            'name' => $data->name,
            'email' => strtolower($data->email),
            'password' => Hash::make($data->password),
            'active' => $data->active,
        ]);

        $this->userService->ensureDefaultProfile($user);

        return $user;
    }
}
