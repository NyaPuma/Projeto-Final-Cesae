<?php

declare(strict_types=1);

namespace App\Observers;

use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Models\UserProfile;

final readonly class UserObserver
{
    /**
     * Handle the User "creating" event.
     */
    public function creating(User $user): void
    {
        $this->ensureValidProfile($user);
    }

    /**
     * Handle the User "updating" event.
     */
    public function updating(User $user): void
    {
        $this->ensureValidProfile($user);
    }

    /**
     * Assegura que o utilizador possui um perfil válido, atribuindo o perfil padrão caso contrário.
     */
    private function ensureValidProfile(User $user): void
    {
        if ($user->profile_id) {
            $profileName = UserProfile::where('id', $user->profile_id)->value('name');

            // Valida se o perfil existe e corresponde a um Enum válido
            if ($profileName && UserRoleEnum::tryFrom($profileName) !== null) {
                return;
            }
        }

        // Garante a existência do perfil padrão e atribui o ID ao utilizador
        $defaultProfile = UserProfile::firstOrCreate([
            'name' => UserRoleEnum::User->value,
        ]);

        $user->profile_id = $defaultProfile->id;
    }
}
