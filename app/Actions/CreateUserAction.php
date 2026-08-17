<?php

namespace App\Actions;

use App\DTOs\StoreUserData;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

final readonly class CreateUserAction
{
    public function __construct(
        private UserService $userService,
    ) {}

    public function execute(StoreUserData $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => trim($data->name),
                'email' => trim(strtolower($data->email)),
                // Se o teu modelo User NÃO tiver 'password' => 'hashed' no $casts:
                'password' => Hash::make($data->password),
                // Se o modelo User já tiver o cast 'hashed', basta: 'password' => $data->password,
                'profile_id' => $data->profileId,
                'active' => $data->active ?? true,
            ]);

            // O UserObserver::creating assegura o perfil default quando profile_id é nulo.

            // Exemplo de disparo de evento no futuro:
            // UserCreated::dispatch($user);

            return $user->load('profile'); // Carrega a relação se o perfil tiver sido criado
        });
    }
}
