<?php

namespace App\Http\Controllers;

use App\Actions\CreateUserAction;
use App\Actions\UpdateUserAction;
use App\DTOs\StoreUserData;
use App\DTOs\UpdateUserData;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\UserProfile;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly CreateUserAction $createUserAction,
        private readonly UpdateUserAction $updateUserAction,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        return response()->json(['users' => $this->userRepository->getAll(['profile'])]);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $data = StoreUserData::fromRequest($request->validated());
        $newUser = $this->createUserAction->execute($data);

        return response()->json(['message' => 'Utilizador criado com sucesso', 'user' => $newUser], 201);
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $targetUser = $this->userRepository->findById($id);
        if (! $targetUser) {
            return response()->json(['message' => 'Utilizador não encontrado'], 404);
        }

        $data = UpdateUserData::fromRequest($request->validated());
        $targetUser = $this->updateUserAction->execute($targetUser, $data);

        return response()->json(['message' => 'Utilizador atualizado', 'user' => $targetUser]);
    }

    public function inactivate(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $targetUser = $this->userRepository->findById($id);
        if (! $targetUser) {
            return response()->json(['message' => 'Utilizador não encontrado'], 404);
        }

        $this->userRepository->inactivate($targetUser);

        return response()->json(['message' => 'Utilizador inativado', 'user' => $targetUser]);
    }

    public function profiles(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        return response()->json(UserProfile::all());
    }
}
