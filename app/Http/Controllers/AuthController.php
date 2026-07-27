<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    ) {}

    public function register(RegisterRequest $request): JsonResponse
    {
        $profile = UserProfile::where('name', User::ROLE_USER)->first();
        if (! $profile) {
            $profile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        }

        $plainToken = Str::random(60);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_id' => $profile->id,
            'active' => true,
            'api_token' => $this->userService->hashToken($plainToken),
            'token_created_at' => now(),
        ]);

        $request->session()->put('api_token', $plainToken);
        $user->load('profile');

        return response()->json(['user' => $user, 'token' => $plainToken], 201)
            ->cookie('api_token', $plainToken, 60 * 24 * 30, '/', null, $request->secure(), true, false, 'Lax')
            ->cookie('auth_token', $plainToken, 60 * 24 * 30, '/', null, $request->secure(), false, false, 'Lax');
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $email = strtolower($request->email);
        $rateLimitKey = "login_attempts:{$email}";
        $maxAttempts = 5;
        $lockoutMinutes = 15;

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

        $plainToken = Str::random(60);
        $user->api_token = $this->userService->hashToken($plainToken);
        $user->token_created_at = now();
        $user->save();

        $request->session()->put('api_token', $plainToken);
        $user->load('profile');

        return response()->json(['user' => $user, 'token' => $plainToken])
            ->cookie('api_token', $plainToken, 60 * 24 * 30, '/', null, $request->secure(), true, false, 'Lax')
            ->cookie('auth_token', $plainToken, 60 * 24 * 30, '/', null, $request->secure(), false, false, 'Lax');
    }

    public function logout(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $user->api_token = null;
        $user->setRememberToken('');
        $user->save();

        $cookie = cookie('api_token', null, -1, '/', null, $request->secure(), true, false, 'Lax');
        $authCookie = cookie('auth_token', null, -1, '/', null, $request->secure(), false, false, 'Lax');

        return response()->json(['message' => __('Sessão terminada com sucesso.')])->withCookie($cookie)->withCookie($authCookie);
    }

    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);

        try {
            $validCurrent = Hash::check($request->current_password, $user->password);
        } catch (\RuntimeException) {
            $validCurrent = password_verify($request->current_password, $user->password);
        }

        if (! $validCurrent) {
            return response()->json(['message' => __('Password atual incorreta')], 403);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => __('Password alterada com sucesso.')]);
    }

    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);

        if (! empty($request->new_password)) {
            if (empty($request->current_password)) {
                return response()->json(['message' => __('A palavra-passe atual é obrigatória para alterar a password.')], 422);
            }

            try {
                $validCurrent = Hash::check($request->current_password, $user->password);
            } catch (\RuntimeException) {
                $validCurrent = password_verify($request->current_password, $user->password);
            }

            if (! $validCurrent) {
                return response()->json(['message' => __('Password atual incorreta')], 403);
            }

            $user->password = Hash::make($request->new_password);
        }

        if (! empty($request->name)) {
            $user->name = $request->name;
        }

        $user->save();
        $user->load('profile');

        return response()->json(['message' => __('Perfil atualizado com sucesso.'), 'user' => $user]);
    }

    public function sendResetLink(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        return response()->json([
            'message' => __('Email de recuperação enviado com sucesso.'),
            'token' => app()->environment('production') ? null : $token,
        ]);
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'token' => ['required', 'string'],
            'password' => ['required', 'confirmed', ...RegisterRequest::passwordRules()],
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->latest('created_at')
            ->first();

        if (! $record || ! Hash::check($request->token, $record->token)) {
            return response()->json(['message' => __('Token inválido ou expirado.')], 422);
        }

        if ($record->created_at && $record->created_at->diffInMinutes(now()) > 60) {
            DB::table('password_reset_tokens')->where('email', $request->email)->delete();

            return response()->json(['message' => __('Token expirado. Solicite um novo.')], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (! $user) {
            return response()->json(['message' => __('Utilizador não encontrado.')], 422);
        }

        $user->password = Hash::make($request->password);
        $user->api_token = null;
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json(['message' => __('Password reposta com sucesso. Faça login.')]);
    }
}
