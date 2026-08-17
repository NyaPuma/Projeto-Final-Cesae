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
     *
     * O token é devolvido no corpo da resposta, mas não é ligado à sessão nem
     * aos cookies do pedido atual: o registo é efetuado por um administrador
     * em nome do novo utilizador e não deve assumir a sessão de quem regista.
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

        // 3. Cria o token de API (sem o ligar à sessão de quem regista)
        $plainToken = $this->userService->createToken($user, $request, false);

        return response()->json([
            'user' => $user,
            'token' => $plainToken,
        ], 201);
    }
}
