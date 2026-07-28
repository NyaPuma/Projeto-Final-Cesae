<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendResetLinkRequest;
use App\Services\PasswordResetService;
use Illuminate\Http\JsonResponse;

class PasswordResetController extends Controller
{
    public function __construct(
        private readonly PasswordResetService $passwordResetService,
    ) {}

    public function sendResetLink(SendResetLinkRequest $request): JsonResponse
    {
        $token = $this->passwordResetService->createResetToken($request->email);

        return response()->json([
            'message' => __('Email de recuperação enviado com sucesso.'),
            'token' => app()->environment('production') ? null : $token,
        ]);
    }

    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $user = $this->passwordResetService->validateToken($request->email, $request->token);

        if (! $user) {
            return response()->json(['message' => __('Token inválido ou expirado.')], 422);
        }

        $this->passwordResetService->resetPassword($user, $request->password);

        return response()->json(['message' => __('Password reposta com sucesso. Faça login.')]);
    }
}
