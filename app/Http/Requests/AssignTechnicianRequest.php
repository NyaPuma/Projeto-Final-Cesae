<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class AssignTechnicianRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'technician_id' => ['nullable', 'integer', 'exists:users,id'],
        ];
    }
}
