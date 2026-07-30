<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required', 'string', 'current_password'],
            'new_password' => ['required', 'string', 'different:current_password', ...RegisterRequest::passwordRules()],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'current_password' => __('palavra-passe atual'),
            'new_password' => __('nova palavra-passe'),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'current_password.required' => __('A palavra-passe atual é obrigatória.'),
            'current_password.current_password' => __('A palavra-passe atual está incorreta.'),
            'new_password.required' => __('A nova palavra-passe é obrigatória.'),
            'new_password.different' => __('A nova palavra-passe deve ser diferente da palavra-passe atual.'),
        ];
    }
}
