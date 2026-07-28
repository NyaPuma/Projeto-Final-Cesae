<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StartTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'force' => ['sometimes', 'boolean'],
        ];
    }
}
