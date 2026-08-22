<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\SendResetLinkRequest;
use App\Mail\PasswordResetMail;
use App\Models\User;
use App\Services\PasswordResetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

final class PasswordResetController extends Controller
{
    public function __construct(
        private readonly PasswordResetService $passwordResetService,
    ) {}

    /**
     * Sends the password recovery link/token to the provided email.
     */
    public function sendResetLink(SendResetLinkRequest $request): JsonResponse
    {
        $email = $request->input('email');
        $token = $this->passwordResetService->createResetToken($email);

        $user = User::where('email', $email)->first();

        if ($user) {
            Mail::to($user)->send(new PasswordResetMail($token));
        }

        return response()->json([
            'message' => __('messages.Email de recuperação enviado com sucesso.'),
            'token' => app()->environment('production') ? null : $token,
        ]);
    }

    /**
     * Performs the password change based on a valid token.
     */
    public function resetPassword(ResetPasswordRequest $request): JsonResponse
    {
        $user = $this->passwordResetService->validateToken(
            $request->input('email'),
            $request->input('token')
        );

        if (! $user) {
            return response()->json([
                'message' => __('validation.Token inválido ou expirado.'),
            ], 422);
        }

        $this->passwordResetService->resetPassword($user, $request->input('password'));

        return response()->json([
            'message' => __('messages.Password reposta com sucesso. Faça login.'),
        ]);
    }
}
