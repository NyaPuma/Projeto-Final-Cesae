<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use OpenApi\Attributes as OA;

class AuthController extends Controller
{
    #[OA\Post(
        path: '/register',
        tags: ['Auth'],
        summary: 'Registar utilizador',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                type: 'object',
                required: ['name', 'email', 'password', 'password_confirmation'],
                properties: [
                    new OA\Property(property: 'name', type: 'string', example: 'João Silva'),
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'joao@example.com'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', example: 'password123'),
                    new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', example: 'password123'),
                    new OA\Property(property: 'profile_id', type: 'integer', nullable: true, example: 1),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Utilizador criado',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(property: 'token', type: 'string', example: 'abc123'),
                        new OA\Property(property: 'user', type: 'object'),
                    ]
                )
            ),
            new OA\Response(response: 422, description: 'Erro de validação'),
        ]
    )]
    public function register(Request $request)
    {
        // Trabalhamos apenas com os campos previstos para evitar efeitos colaterais no request.
        $data = $request->only(['name', 'email', 'password', 'password_confirmation', 'profile_id']);

        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_id' => ['nullable', 'integer', 'exists:user_profiles,id'],
        ]);

        // Qualquer falha de validação devolve a lista completa de erros para o frontend.
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $profile = isset($data['profile_id'])
            ? UserProfile::find($data['profile_id'])
            : UserProfile::where('name', User::ROLE_USER)->first();

        if (! $profile) {
            $profile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
        }

        $profileId = $profile->id;

        $plainToken = Str::random(60);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'profile_id' => $profileId,
            'active' => true,
            'api_token' => User::hashToken($plainToken),
            'token_created_at' => now(),
        ]);

        $request->session()->put('api_token', $plainToken);

        $user->load('profile');

        return response()->json(['user' => $user, 'token' => $plainToken], 201)
            ->cookie('api_token', $plainToken, 60 * 24 * 30, '/', null, true, true, false, 'Lax');
    }

    #[OA\Post(
        path: '/login',
        tags: ['Auth'],
        summary: 'Autenticar utilizador',
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                type: 'object',
                required: ['email', 'password'],
                properties: [
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'joao@example.com'),
                    new OA\Property(property: 'password', type: 'string', format: 'password', example: 'password123'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Autenticado com sucesso',
                content: new OA\JsonContent(
                    type: 'object',
                    properties: [
                        new OA\Property(property: 'token', type: 'string', example: 'abc123'),
                        new OA\Property(property: 'user', type: 'object'),
                    ]
                )
            ),
            new OA\Response(response: 401, description: 'Credenciais inválidas'),
        ]
    )]
    public function login(Request $request)
    {
        // O login só aceita os campos essenciais.
        $data = $request->only(['email', 'password']);

        $validator = Validator::make($data, [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Rejeita logo pedidos incompletos ou mal estruturados.
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Não distinguimos email inexistente de password errada por segurança.
        $user = User::where('email', $data['email'])->where('active', true)->first();

        $valid = false;
        if ($user) {
            try {
                $valid = Hash::check($data['password'], $user->password);
            } catch (\RuntimeException) {
                // Hash legacy (ex: bcrypt) — valida com PHP nativo e rehash a seguir.
                $valid = password_verify($data['password'], $user->password);
            }
        }

        if (! $valid) {
            return response()->json(['message' => __('Credenciais inválidas.')], 401);
        }

        // Rehash transparente: se a hash não corresponde ao algoritmo atual, regenera automaticamente.
        if ($user && Hash::needsRehash($user->password)) {
            $user->password = Hash::make($data['password']);
            $user->save();
        }

        // Garante que, se o registo ficou sem perfil, o acesso volta a usar o perfil base.
        if (! $user->profile_id) {
            $defaultProfile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);
            $user->profile_id = $defaultProfile->id;
        }

        // Renovar o token invalida acessos antigos e simplifica a gestão da sessão.
        $plainToken = Str::random(60);
        $user->api_token = User::hashToken($plainToken);
        $user->token_created_at = now();
        $user->save();

        $request->session()->put('api_token', $plainToken);

        $user->load('profile');

        return response()->json(['user' => $user, 'token' => $plainToken])
            ->cookie('api_token', $plainToken, 60 * 24 * 30, '/', null, true, true, false, 'Lax');
    }

    public function logout(Request $request)
    {
        // O logout limpa token persistido e cookie para fechar a sessão em todos os canais.
        $user = $this->authenticatedUser($request);
        $user->api_token = null;
        $user->setRememberToken('');
        $user->save();

        $cookie = cookie('api_token', null, -1, '/', null, true, true, false, 'Lax');

        return response()->json(['message' => __('Sessão terminada com sucesso.')])->withCookie($cookie);
    }

    public function changePassword(Request $request)
    {
        $user = $this->authenticatedUser($request);

        // Mudamos apenas a password, mantendo o resto do perfil intacto.
        $data = $request->only(['current_password', 'new_password']);

        $validator = Validator::make($data, [
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8'],
        ]);

        // Erros de validação são devolvidos para o frontend poder corrigir o formulário.
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Confirmamos a password antiga antes de autorizar a alteração.
        try {
            $validCurrent = Hash::check($data['current_password'], $user->password);
        } catch (\RuntimeException) {
            $validCurrent = password_verify($data['current_password'], $user->password);
        }

        if (! $validCurrent) {
            return response()->json(['message' => __('Password atual incorreta')], 403);
        }

        // Guardamos sempre a nova password com hash.
        $user->password = Hash::make($data['new_password']);
        $user->save();

        return response()->json(['message' => __('Password alterada com sucesso.')]);
    }

    public function updateProfile(Request $request)
    {
        $user = $this->authenticatedUser($request);

        $data = $request->only(['name', 'current_password', 'new_password']);

        $validator = Validator::make($data, [
            'name' => ['nullable', 'string', 'max:255'],
            'current_password' => ['nullable', 'string'],
            'new_password' => ['nullable', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (! empty($data['new_password'])) {
            if (empty($data['current_password'])) {
                return response()->json(['message' => __('A palavra-passe atual é obrigatória para alterar a password.')], 422);
            }

            try {
                $validCurrent = Hash::check($data['current_password'], $user->password);
            } catch (\RuntimeException) {
                $validCurrent = password_verify($data['current_password'], $user->password);
            }

            if (! $validCurrent) {
                return response()->json(['message' => __('Password atual incorreta')], 403);
            }

            $user->password = Hash::make($data['new_password']);
        }

        if (! empty($data['name'])) {
            $user->name = $data['name'];
        }

        $user->save();
        $user->load('profile');

        return response()->json(['message' => __('Perfil atualizado com sucesso.'), 'user' => $user]);
    }

    /**
     * Envia email com link de reset de password.
     * Rota: POST /api/password/email
     */
    public function sendResetLink(Request $request)
    {
        $data = $request->only(['email']);
        $validator = Validator::make($data, [
            'email' => ['required', 'email', 'exists:users,email'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $data['email']],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        // Em produção, enviar email com o token. Em dev, devolver no response.
        if (app()->environment('production')) {
            // TODO: Enviar email com link para /api/password/reset/{token}
            // Mail::raw(...);
        }

        return response()->json([
            'message' => __('Email de recuperação enviado com sucesso.'),
            'token' => app()->environment('production') ? null : $token,
        ]);
    }

    /**
     * Repõe a password do utilizador usando o token de reset.
     * Rota: POST /api/password/reset
     */
    public function resetPassword(Request $request)
    {
        $data = $request->only(['email', 'password', 'password_confirmation', 'token']);

        $validator = Validator::make($data, [
            'email' => ['required', 'email'],
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $record = DB::table('password_reset_tokens')
            ->where('email', $data['email'])
            ->latest('created_at')
            ->first();

        if (! $record || ! Hash::check($data['token'], $record->token)) {
            return response()->json(['message' => __('Token inválido ou expirado.')], 422);
        }

        // Token expira em 60 minutos
        if ($record->created_at && $record->created_at->diffInMinutes(now()) > 60) {
            DB::table('password_reset_tokens')->where('email', $data['email'])->delete();

            return response()->json(['message' => __('Token expirado. Solicite um novo.')], 422);
        }

        $user = User::where('email', $data['email'])->first();
        if (! $user) {
            return response()->json(['message' => __('Utilizador não encontrado.')], 422);
        }

        $user->password = Hash::make($data['password']);
        $user->api_token = null;
        $user->save();

        // Invalidar todos os tokens de reset deste email
        DB::table('password_reset_tokens')->where('email', $data['email'])->delete();

        return response()->json(['message' => __('Password reposta com sucesso. Faça login.')]);
    }
}
