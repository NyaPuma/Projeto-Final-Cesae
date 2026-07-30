<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

final class RegisterController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    ) {}

    /**
     * Regista um novo utilizador no sistema e emite o token de acesso.
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        // 1. Garante a existência do perfil de utilizador comum padrão
        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);

        // 2. Cria o novo registo de utilizador com dados validados
        $user = User::create([
            'name' => $request->validated('name'),
            'email' => strtolower($request->validated('email')),
            'password' => Hash::make($request->validated('password')),
            'profile_id' => $profile->id,
            'active' => true,
        ]);

        // 3. Cria o token de API e constrói a resposta de autenticação
        $plainToken = $this->userService->createToken($user, $request);

        return $this->userService->buildAuthResponse($user, $plainToken, $request, 201);
    }
}
