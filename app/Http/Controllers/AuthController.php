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
     * Authenticates a user based on the submitted credentials.
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $email = strtolower($request->input('email'));
        $rateLimitKey = "login_attempts:{$email}";

        $maxAttempts = config('services.custom.auth.max_attempts', 5);
        $lockoutMinutes = config('services.custom.auth.lockout_minutes', 15);

        // 1. Check the login attempt rate limit (Rate Limiting via Cache)
        $attempts = Cache::get($rateLimitKey, 0);
        if ($attempts >= $maxAttempts) {
            return response()->json([
                'message' => __('common.Conta temporariamente bloqueada. Tente novamente mais tarde.'),
            ], 429)->header('Retry-After', (string) ($lockoutMinutes * 60));
        }

        // 2. Find the active user
        $user = \App\Models\User::where('email', $email)
            ->where('active', true)
            ->first();

        // 3. Validate credentials
        $valid = $user && Hash::check($request->input('password'), $user->password);

        if (! $valid) {
        // Atomic increment: Cache::add seeds the key with TTL on first failure;
        // Cache::increment ensures correct count under concurrency.
            if (! Cache::add($rateLimitKey, 1, now()->addMinutes($lockoutMinutes))) {
                Cache::increment($rateLimitKey);
            }

            return response()->json([
                'message' => __('common.Credenciais inválidas.'),
            ], 401);
        }

        // 4. Clear failed attempts on success
        Cache::forget($rateLimitKey);

        // 5. Rehash password hash if needed (automatic re-hash)
        if (Hash::needsRehash($user->password)) {
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }

        // 6. Ensure profile exists and create session/api token
        $this->userService->ensureDefaultProfile($user);
        $plainToken = $this->userService->createToken($user, $request);

        return $this->userService->buildAuthResponse($user, $plainToken, $request);
    }

    /**
     * Terminates the authenticated user's session.
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
