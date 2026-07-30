<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StorePreventiveRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'scheduled_at' => ['required', 'date'],
            'technician_id' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}
