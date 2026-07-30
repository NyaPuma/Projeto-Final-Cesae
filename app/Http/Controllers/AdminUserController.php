<?php

namespace App\Http\Controllers;

use App\Actions\CreateUserAction;
use App\Actions\UpdateUserAction;
use App\DTOs\StoreUserData;
use App\DTOs\UpdateUserData;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserProfileResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\UserProfile;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class AdminUserController extends Controller
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly CreateUserAction $createUserAction,
        private readonly UpdateUserAction $updateUserAction,
    ) {}

    /**
     * Lista todos os utilizadores com os seus respetivos perfis.
     */
    public function index(Request $request): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('viewAny', User::class);

        // 2. Procura de utilizadores com eager loading do perfil
        $users = $this->userRepository->getAll(['profile']);

        return response()->json([
            'users' => UserResource::collection($users),
        ]);
    }

    /**
     * Regista um novo utilizador no sistema.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('create', User::class);

        // 2. Executa DTO e Action para criação
        $data = StoreUserData::fromRequest($request->validated());
        $newUser = $this->createUserAction->execute($data);

        $newUser->loadMissing('profile');

        return response()->json([
            'message' => __('Utilizador criado com sucesso.'),
            'user' => new UserResource($newUser),
        ], 201);
    }

    /**
     * Atualiza as informações de um utilizador existente.
     */
    public function update(UpdateUserRequest $request, User $targetUser): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('update', $targetUser);

        // 2. Executa DTO e Action para atualização
        $data = UpdateUserData::fromRequest($request->validated());
        $updatedUser = $this->updateUserAction->execute($targetUser, $data);

        $updatedUser->loadMissing('profile');

        return response()->json([
            'message' => __('Utilizador atualizado com sucesso.'),
            'user' => new UserResource($updatedUser),
        ]);
    }

    /**
     * Inativa a conta de um utilizador no sistema.
     */
    public function inactivate(Request $request, User $targetUser): JsonResponse
    {
        // 1. Autorização via Policy
        $this->authorize('inactivate', $targetUser);

        // 2. Regra de negócio: impede que o próprio administrador se inative a si mesmo
        if ($request->user()->id === $targetUser->id) {
            return response()->json([
                'message' => __('Não é possível inativar a sua própria conta.'),
            ], 422);
        }

        // 3. Inativação do utilizador via Repositório
        $this->userRepository->inactivate($targetUser);

        $targetUser->loadMissing('profile');

        return response()->json([
            'message' => __('Utilizador inativado com sucesso.'),
            'user' => new UserResource($targetUser),
        ]);
    }

    /**
     * Lista todos os perfis/funções disponíveis no sistema.
     */
    public function profiles(Request $request): JsonResponse
    {
        // 1. Autorização via Policy (ou reutilização de permissão da model UserProfile)
        $this->authorize('viewAny', UserProfile::class);

        $profiles = UserProfile::all();

        return response()->json([
            'profiles' => UserProfileResource::collection($profiles),
        ]);
    }
}
