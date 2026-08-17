<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

final class AuthController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    ) {}

    /**
     * Autentica um utilizador com base nas credenciais submetidas.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $email = strtolower($request->input('email'));
        $rateLimitKey = "login_attempts:{$email}";

        $maxAttempts = config('services.custom.auth.max_attempts', 5);
        $lockoutMinutes = config('services.custom.auth.lockout_minutes', 15);

        // 1. Verifica o limite de tentativas de login (Rate Limiting via Cache)
        $attempts = Cache::get($rateLimitKey, 0);
        if ($attempts >= $maxAttempts) {
            return response()->json([
                'message' => __('common.Conta temporariamente bloqueada. Tente novamente mais tarde.'),
            ], 429)->header('Retry-After', (string) ($lockoutMinutes * 60));
        }

        // 2. Procura o utilizador ativo
        $user = \App\Models\User::where('email', $email)
            ->where('active', true)
            ->first();

        // 3. Validação das credenciais
        $valid = $user && Hash::check($request->input('password'), $user->password);

        if (! $valid) {
            // Incremento atómico: Cache::add semeia a chave com TTL no 1º insucesso;
            // Cache::increment garante contagem correta sob concorrência.
            if (! Cache::add($rateLimitKey, 1, now()->addMinutes($lockoutMinutes))) {
                Cache::increment($rateLimitKey);
            }

            return response()->json([
                'message' => __('common.Credenciais inválidas.'),
            ], 401);
        }

        // 4. Limpa as tentativas falhadas em caso de sucesso
        Cache::forget($rateLimitKey);

        // 5. Atualiza o hash da password se necessário (re-hash automático)
        if (Hash::needsRehash($user->password)) {
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }

        // 6. Garante o perfil e cria o token de sessão/api
        $this->userService->ensureDefaultProfile($user);
        $plainToken = $this->userService->createToken($user, $request);

        return $this->userService->buildAuthResponse($user, $plainToken, $request);
    }

    /**
     * Termina a sessão do utilizador autenticado.
     */
    public function logout(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);

        $user->api_token = null;
        $user->setRememberToken('');
        $user->save();

        return $this->userService->buildLogoutResponse($request);
    }
}
