<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

final class UpdateProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Limpa espaços sobressalentes nos dados enviados.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('name')) {
            $this->merge([
                'name' => $this->filled('name') ? trim((string) $this->name) : $this->name,
            ]);
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'current_password' => [
                'required_with:new_password',
                'nullable',
                'string',
                'current_password',
            ],
            'new_password' => [
                'nullable',
                'string',
                (static function () {
                    $rule = Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols();
                    if (! app()->environment('testing')) {
                        $rule->uncompromised();
                    }
                    return $rule;
                })(),
                'confirmed',
            ],
        ];
    }

    /**
     * Nomes amigáveis dos atributos para as mensagens de erro do Laravel.
     */
    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'current_password' => 'palavra-passe atual',
            'new_password' => 'nova palavra-passe',
            'new_password_confirmation' => 'confirmação da nova palavra-passe',
        ];
    }
}
