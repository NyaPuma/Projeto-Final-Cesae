<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class RequestBudgetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'budget_amount' => ['required', 'numeric', 'min:0.01'],
            'budget_details' => ['nullable', 'array'],
            'budget_details.*.description' => ['required_with:budget_details', 'string', 'max:255'],
            'budget_details.*.quantity' => ['required_with:budget_details', 'numeric', 'min:1'],
            'budget_details.*.unit_price' => ['required_with:budget_details', 'numeric', 'min:0'],
        ];
    }
}
