<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('id');

        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'email', 'max:255', "unique:users,email,{$userId}"],
            'password' => ['nullable', ...RegisterRequest::passwordRules()],
            'profile_id' => ['sometimes', 'integer', 'exists:user_profiles,id'],
            'active' => ['sometimes', 'boolean'],
        ];
    }
}
