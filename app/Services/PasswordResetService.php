<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

final class PasswordResetService
{
    /**
     * Cria e armazena um token seguro de redefinição de palavra-passe para o e-mail fornecido.
     *
     * @param string $email
     * @return string
     */
    public function createResetToken(string $email): string
    {
        $normalizedEmail = strtolower($email);
        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $normalizedEmail],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        return $token;
    }

    /**
     * Valida o token de redefinição de palavra-passe, verificando a expiração e correspondência.
     *
     * @param string $email
     * @param string $token
     * @return User|null
     */
    public function validateToken(string $email, string $token): ?User
    {
        $normalizedEmail = strtolower($email);

        $record = DB::table('password_reset_tokens')
            ->where('email', $normalizedEmail)
            ->latest('created_at')
            ->first();

        if (! $record || ! Hash::check($token, $record->token)) {
            return null;
        }

        if ($record->created_at) {
            $createdAt = Carbon::parse($record->created_at);

            if ($createdAt->diffInMinutes(now()) > 60) {
                DB::table('password_reset_tokens')->where('email', $normalizedEmail)->delete();

                return null;
            }
        }

        return User::where('email', $normalizedEmail)->first();
    }

    /**
     * Redefine a palavra-passe do utilizador, revoga tokens de API associados e remove o registo de recuperação.
     *
     * @param User $user
     * @param string $password
     */
    public function resetPassword(User $user, string $password): void
    {
        $user->password = Hash::make($password);
        $user->api_token = null;
        $user->save();

        DB::table('password_reset_tokens')->where('email', strtolower($user->email))->delete();
    }
}
