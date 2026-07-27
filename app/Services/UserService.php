<?php

namespace App\Services;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

final class UserService
{
    public function getAvailableRoles(): array
    {
        return UserRoleEnum::values();
    }

    public function ensureDefaultProfile(User $user): void
    {
        if ($user->profile_id) {
            return;
        }

        $defaultProfile = UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);
        $user->profile_id = $defaultProfile->id;
    }

    public function hashToken(string $token): string
    {
        return hash_hmac('sha256', $token, config('app.key'));
    }

    public function createToken(User $user, Request $request): string
    {
        $plainToken = Str::random(60);
        $user->api_token = $this->hashToken($plainToken);
        $user->token_created_at = now();
        $user->save();

        $request->session()->put('api_token', $plainToken);
        $user->load('profile');

        return $plainToken;
    }

    public function buildAuthResponse(User $user, string $plainToken, Request $request, int $statusCode = 200): JsonResponse
    {
        return response()->json(['user' => $user, 'token' => $plainToken], $statusCode)
            ->cookie('api_token', $plainToken, 60 * 24 * 30, '/', null, $request->secure(), true, false, 'Lax')
            ->cookie('auth_token', $plainToken, 60 * 24 * 30, '/', null, $request->secure(), false, false, 'Lax');
    }

    public function buildLogoutResponse(Request $request): JsonResponse
    {
        return response()->json(['message' => __('Sessão terminada com sucesso.')])
            ->withCookie(cookie('api_token', null, -1, '/', null, $request->secure(), true, false, 'Lax'))
            ->withCookie(cookie('auth_token', null, -1, '/', null, $request->secure(), false, false, 'Lax'));
    }
}
