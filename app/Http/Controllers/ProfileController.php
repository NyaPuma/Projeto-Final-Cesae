<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

final class ProfileController extends Controller
{
    /**
     * Altera a password do utilizador autenticado.
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = $request->user();

        if (! Hash::check($request->input('current_password'), $user->password)) {
            return response()->json([
                'message' => __('Password atual incorreta.'),
            ], 403);
        }

        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response()->json([
            'message' => __('Password alterada com sucesso.'),
        ]);
    }

    /**
     * Atualiza os dados do perfil do utilizador autenticado.
     */
    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        $user = $request->user();

        $newPassword = $request->input('password');

        if (! empty($newPassword)) {
            $currentPassword = $request->input('current_password');

            if (empty($currentPassword)) {
                return response()->json([
                    'message' => __('A palavra-passe atual é obrigatória para alterar a password.'),
                ], 422);
            }

            if (! Hash::check($currentPassword, $user->password)) {
                return response()->json([
                    'message' => __('Password atual incorreta.'),
                ], 403);
            }

            $user->password = Hash::make($newPassword);
        }

        $name = $request->input('name');

        if (! empty($name)) {
            $user->name = $name;
        }

        $user->save();
        $user->loadMissing('profile');

        return response()->json([
            'message' => __('Perfil atualizado com sucesso.'),
            'user' => new UserResource($user),
        ]);
    }
}
