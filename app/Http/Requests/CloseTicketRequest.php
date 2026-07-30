<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class CloseTicketRequest extends FormRequest
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
            'actual_cost' => ['required', 'numeric', 'min:0'],
            'report' => ['nullable', 'string', 'max:5000'],
            'force' => ['nullable', 'boolean'],
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
            'actual_cost' => __('custo real'),
            'report' => __('relatório técnico'),
            'force' => __('forçar encerramento'),
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
            'actual_cost.required' => __('O custo real é obrigatório.'),
            'actual_cost.numeric' => __('O custo real deve ser um valor numérico.'),
            'actual_cost.min' => __('O custo real não pode ser um valor negativo.'),
            'report.max' => __('O relatório técnico não pode exceder 5000 caracteres.'),
            'force.boolean' => __('O campo forçar encerramento deve ser verdadeiro ou falso.'),
        ];
    }
}
