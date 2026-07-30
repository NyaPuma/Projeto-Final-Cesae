<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

final class UserService
{
    /**
     * Retorna os papéis de utilizador disponíveis.
     *
     * @return array<int, string>
     */
    public function getAvailableRoles(): array
    {
        return UserRoleEnum::values();
    }

    /**
     * Garante que o utilizador possui um perfil predefinido associado.
     *
     * @param User $user
     */
    public function ensureDefaultProfile(User $user): void
    {
        if ($user->profile_id) {
            return;
        }

        /** @var UserProfile $defaultProfile */
        $defaultProfile = UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);
        $user->profile_id = $defaultProfile->id;
    }

    /**
     * Gera um hash seguro para o token de API utilizando a chave da aplicação.
     *
     * @param string $token
     * @return string
     */
    public function hashToken(string $token): string
    {
        /** @var string $appKey */
        $appKey = config('app.key');

        return hash_hmac('sha256', $token, $appKey);
    }

    /**
     * Cria e persiste um novo token de API para o utilizador e atualiza a sessão.
     *
     * @param User $user
     * @param Request $request
     * @return string
     */
    public function createToken(User $user, Request $request): string
    {
        /** @var int $tokenLength */
        $tokenLength = config('services.custom.tokens.length', 60);

        $plainToken = Str::random($tokenLength);
        $user->api_token = $this->hashToken($plainToken);
        $user->token_created_at = now();
        $user->save();

        $request->session()->regenerate();
        $request->session()->put('api_token', $plainToken);
        $request->session()->save();
        $user->load('profile');

        return $plainToken;
    }

    /**
     * Constrói a resposta JSON de autenticação com os respetivos cookies de token.
     *
     * @param User $user
     * @param string $plainToken
     * @param Request $request
     * @param int $statusCode
     * @return JsonResponse
     */
    public function buildAuthResponse(User $user, string $plainToken, Request $request, int $statusCode = 200): JsonResponse
    {
        $secure = $request->secure();

        return response()->json(['user' => $user, 'token' => $plainToken], $statusCode)
            ->cookie('api_token', $plainToken, 60 * 24 * 30, '/', null, $secure, true, false, 'Lax')
            ->cookie('auth_token', $plainToken, 60 * 24 * 30, '/', null, $secure, false, false, 'Lax');
    }

    /**
     * Constrói a resposta JSON de término de sessão (logout), invalidando a sessão e removendo cookies.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function buildLogoutResponse(Request $request): JsonResponse
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $secure = $request->secure();

        return response()->json(['message' => __('Sessão terminada com sucesso.')])
            ->withCookie(cookie('api_token', null, -1, '/', null, $secure, true, false, 'Lax'))
            ->withCookie(cookie('auth_token', null, -1, '/', null, $secure, false, false, 'Lax'));
    }
}
