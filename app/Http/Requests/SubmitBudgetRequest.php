<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class SubmitBudgetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'estimatedBudget' => ['required', 'numeric', 'min:0.01'],
            'budget_details' => ['nullable', 'array'],
            'budget_details.*.description' => ['required_with:budget_details', 'string', 'max:255'],
            'budget_details.*.type' => ['nullable', 'string', 'in:material,labor'],
            'budget_details.*.quantity' => ['nullable', 'numeric', 'min:0'],
            'budget_details.*.unit_price' => ['nullable', 'numeric', 'min:0'],
            'budget_details.*.hours' => ['nullable', 'numeric', 'min:0'],
            'budget_details.*.hourly_rate' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}
