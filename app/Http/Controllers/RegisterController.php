<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Models\UserProfile;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    ) {}

    public function __invoke(RegisterRequest $request): JsonResponse
    {
        $profile = UserProfile::firstOrCreate(['name' => User::ROLE_USER]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_id' => $profile->id,
            'active' => true,
        ]);

        $plainToken = $this->userService->createToken($user, $request);

        return $this->userService->buildAuthResponse($user, $plainToken, $request, 201);
    }
}
