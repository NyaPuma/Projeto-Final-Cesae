<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    use AuthorizesRequests;
    /**
     * Gets the authenticated user from the API guard or the default request.
     */
    protected function authenticatedUser(Request $request): User
    {
        $user = Auth::guard('api')->user() ?? $request->user();

        if (! $user) {
            abort(401, __('auth.Autenticação necessária. Envie o token de autenticação no cabeçalho.'));
        }

        return $user;
    }
}
