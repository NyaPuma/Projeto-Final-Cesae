<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        return response()->json(['users' => User::with('profile')->get()]);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $validated['active'] = true;

        $newUser = User::create($validated);

        return response()->json(['message' => 'Utilizador criado com sucesso', 'user' => $newUser], 201);
    }

    public function update(UpdateUserRequest $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $targetUser = User::findOrFail($id);
        $validated = $request->validated();

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $targetUser->update($validated);

        return response()->json(['message' => 'Utilizador atualizado', 'user' => $targetUser]);
    }

    public function inactivate(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $targetUser = User::findOrFail($id);
        $targetUser->update(['active' => false]);

        return response()->json(['message' => 'Utilizador inativado', 'user' => $targetUser]);
    }

    public function profiles(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        return response()->json(UserProfile::all());
    }
}
