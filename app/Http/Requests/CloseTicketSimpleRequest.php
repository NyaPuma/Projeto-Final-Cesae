<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CloseTicketSimpleRequest extends FormRequest
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
            'minutes_spent' => ['nullable', 'integer', 'min:0'],
            'cost' => ['nullable', 'numeric', 'min:0'],
            'technical_report' => ['nullable', 'string', 'max:5000'],
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
            'minutes_spent' => __('minutos despendidos'),
            'cost' => __('custo'),
            'technical_report' => __('relatório técnico'),
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
            'minutes_spent.integer' => __('O tempo despendido deve ser um número inteiro de minutos.'),
            'minutes_spent.min' => __('O tempo despendido não pode ser um valor negativo.'),
            'cost.numeric' => __('O custo deve ser um valor numérico.'),
            'cost.min' => __('O custo não pode ser um valor negativo.'),
            'technical_report.max' => __('O relatório técnico não pode exceder 5000 caracteres.'),
        ];
    }
}
