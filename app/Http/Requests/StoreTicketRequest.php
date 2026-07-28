<?php

namespace App\Http\Requests;

use App\Enums\TicketPriorityEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'priority' => ['required', 'string', Rule::in(array_merge(
                TicketPriorityEnum::values(),
                ['media', 'critica']
            ))],
            'equipment_id' => ['nullable', 'integer', 'exists:equipments,id'],
            'room_id' => ['nullable', 'integer', 'exists:rooms,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título é obrigatório.',
            'title.max' => 'O título não pode exceder 255 caracteres.',
            'description.required' => 'A descrição é obrigatória.',
            'description.max' => 'A descrição não pode exceder 5000 caracteres.',
            'priority.required' => 'A prioridade é obrigatória.',
            'priority.in' => 'A prioridade deve ser baixa, média, alta ou crítica.',
            'equipment_id.exists' => 'O equipamento selecionado não existe.',
            'room_id.exists' => 'A sala selecionada não existe.',
        ];
    }
}
