<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class BudgetDecisionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'decision' => ['required', 'string', 'in:approve,reject'],
            'feedback' => ['nullable', 'string', 'max:5000', 'required_if:decision,reject'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'decision' => __('decisão'),
            'feedback' => __('feedback/justificação'),
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'decision.required' => __('A decisão sobre o orçamento é obrigatória.'),
            'decision.in' => __('A decisão deve ser aprovar (approve) ou rejeitar (reject).'),
            'feedback.required_if' => __('É obrigatório fornecer um feedback/justificação ao rejeitar o orçamento.'),
            'feedback.max' => __('O feedback não pode exceder 5000 caracteres.'),
        ];
    }
}
