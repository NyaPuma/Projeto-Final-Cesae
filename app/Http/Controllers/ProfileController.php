<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);

        if (! Hash::check($request->current_password, $user->password)) {
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

            if (! Hash::check($request->current_password, $user->password)) {
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
}
