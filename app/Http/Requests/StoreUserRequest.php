<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

final class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Limpa espaços extras e normaliza o email antes da validação.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->filled('name') ? trim((string) $this->name) : $this->name,
            'email' => $this->filled('email') ? strtolower(trim((string) $this->email)) : $this->email,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class, 'email'),
            ],
            'password' => [
                'required',
                'string',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'profile_id' => [
                'required',
                'integer',
                Rule::exists(UserProfile::class, 'id'),
            ],
            'active' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * Mapeia os nomes dos atributos para as mensagens de erro do Laravel.
     */
    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'email' => 'email',
            'password' => 'palavra-passe',
            'profile_id' => 'perfil',
            'active' => 'status ativo',
        ];
    }
}
