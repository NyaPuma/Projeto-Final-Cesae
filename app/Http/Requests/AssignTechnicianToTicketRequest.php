<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class AssignTechnicianToTicketRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'technician_id' => [
                'nullable',
                'integer',
                Rule::exists('users', 'id'),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'technician_id' => __('common.técnico'),
        ];
    }

    public function messages(): array
    {
        return [
            'technician_id.required' => __('validation.O campo técnico é obrigatório.'),
            'technician_id.integer' => __('validation.O identificador do técnico deve ser um número inteiro.'),
            'technician_id.exists' => __('validation.O técnico selecionado é inválido.'),
        ];
    }
}
