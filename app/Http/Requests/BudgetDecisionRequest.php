<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class BudgetDecisionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'decision' => ['nullable', 'string', 'in:approve,reject'],
            'feedback' => ['nullable', 'string', 'max:5000'],
        ];
    }
}
