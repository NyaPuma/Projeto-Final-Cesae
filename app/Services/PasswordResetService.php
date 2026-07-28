<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class PasswordResetService
{
    public function createResetToken(string $email): string
    {
        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        return $token;
    }

    public function validateToken(string $email, string $token): ?User
    {
        $record = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->latest('created_at')
            ->first();

        if (! $record || ! Hash::check($token, $record->token)) {
            return null;
        }

        if ($record->created_at && $record->created_at->diffInMinutes(now()) > 60) {
            DB::table('password_reset_tokens')->where('email', $email)->delete();

            return null;
        }

        return User::where('email', $email)->first();
    }

    public function resetPassword(User $user, string $password): void
    {
        $user->password = Hash::make($password);
        $user->api_token = null;
        $user->save();

        DB::table('password_reset_tokens')->where('email', $user->email)->delete();
    }
}
