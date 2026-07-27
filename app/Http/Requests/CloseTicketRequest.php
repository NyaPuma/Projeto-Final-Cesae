<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CloseTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'actual_cost' => ['required', 'numeric', 'min:0'],
            'report' => ['nullable', 'string', 'max:5000'],
            'force' => ['nullable', 'boolean'],
        ];
    }
}
