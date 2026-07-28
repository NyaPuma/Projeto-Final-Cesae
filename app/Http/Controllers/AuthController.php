<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        $email = strtolower($request->email);
        $rateLimitKey = "login_attempts:{$email}";
        $maxAttempts = config('services.custom.auth.max_attempts');
        $lockoutMinutes = config('services.custom.auth.lockout_minutes');

        $attempts = Cache::get($rateLimitKey, 0);
        if ($attempts >= $maxAttempts) {
            return response()->json([
                'message' => __('Conta temporariamente bloqueada. Tente novamente mais tarde.'),
            ], 429)->header('Retry-After', (string) ($lockoutMinutes * 60));
        }

        $user = User::where('email', $email)->where('active', true)->first();

        $valid = false;
        if ($user) {
            try {
                $valid = Hash::check($request->password, $user->password);
            } catch (\RuntimeException) {
                $valid = password_verify($request->password, $user->password);
            }
        }

        if (! $valid) {
            Cache::put($rateLimitKey, $attempts + 1, now()->addMinutes($lockoutMinutes));

            return response()->json(['message' => __('Credenciais inválidas.')], 401);
        }

        Cache::forget($rateLimitKey);

        if (Hash::needsRehash($user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        $this->userService->ensureDefaultProfile($user);
        $plainToken = $this->userService->createToken($user, $request);

        return $this->userService->buildAuthResponse($user, $plainToken, $request);
    }

    public function logout(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $user->api_token = null;
        $user->setRememberToken('');
        $user->save();

        return $this->userService->buildLogoutResponse($request);
    }
}
