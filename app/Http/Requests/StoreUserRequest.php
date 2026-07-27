<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', ...RegisterRequest::passwordRules()],
            'profile_id' => ['required', 'integer', 'exists:user_profiles,id'],
            'active' => ['sometimes', 'boolean'],
        ];
    }
}
