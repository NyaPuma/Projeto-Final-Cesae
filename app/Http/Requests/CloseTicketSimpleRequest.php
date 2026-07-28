<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CloseTicketSimpleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'minutes_spent' => ['nullable', 'integer', 'min:0'],
            'cost' => ['nullable', 'numeric', 'min:0'],
            'technical_report' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
