<?php

namespace App\Http\Controllers;

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

        $users = User::with('profile')->get();

        return response()->json(['users' => $users]);
    }

    public function store(Request $request): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'role' => 'required|string|in:user,technician,admin',
            'profile_id' => 'required|exists:user_profiles,id',
        ]);

        $newUser = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
            'profile_id' => $validated['profile_id'],
            'active' => true,
        ]);

        return response()->json(['message' => 'Utilizador criado com sucesso', 'user' => $newUser], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $user = $this->authenticatedUser($request);
        $this->requireRole($user, [User::ROLE_ADMIN]);

        $targetUser = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,'.$id,
            'phone' => 'nullable|string|max:20',
            'role' => 'sometimes|string|in:user,technician,admin',
            'profile_id' => 'sometimes|exists:user_profiles,id',
        ]);

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

        $profiles = UserProfile::all();

        return response()->json($profiles);
    }
}
