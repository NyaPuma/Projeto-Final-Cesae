<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

final class RegisterController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    ) {}

    /**
     * Registers a new user in the system and issues an access token.
     *
     * The token is returned in the response body but is not linked to the session or
     * the current request's cookies: the registration is performed by an administrator
     * on behalf of the new user and should not assume the registrant's session.
     */
    public function __invoke(RegisterRequest $request): JsonResponse
    {
        // 1. Ensure the default regular user profile exists
        $profile = UserProfile::firstOrCreate(['name' => UserRoleEnum::User->value]);

        // 2. Create the new user record with validated data
        $user = User::create([
            'name' => $request->validated('name'),
            'email' => strtolower($request->validated('email')),
            'password' => Hash::make($request->validated('password')),
            'profile_id' => $profile->id,
            'active' => true,
        ]);

        // 3. Create the API token (without linking to the registrant's session)
        $plainToken = $this->userService->createToken($user, $request, false);

        return response()->json([
            'user' => $user,
            'token' => $plainToken,
        ], 201);
    }
}
