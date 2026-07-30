<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StoreRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome da sala é obrigatório.',
            'name.max' => 'O nome não pode exceder 255 caracteres.',
            'location.max' => 'A localização não pode exceder 255 caracteres.',
        ];
    }
}
