<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class StoreEquipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'serial' => ['required', 'string', 'max:255', 'unique:equipments,serial'],
            'room_id' => ['nullable', 'exists:rooms,id'],
            'category_id' => ['nullable', 'exists:equipment_categories,id'],
            'active' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do equipamento é obrigatório.',
            'name.max' => 'O nome não pode exceder 255 caracteres.',
            'serial.required' => 'O número de série é obrigatório.',
            'serial.unique' => 'Este número de série já está em uso.',
            'room_id.exists' => 'A sala selecionada não existe.',
            'category_id.exists' => 'A categoria selecionada não existe.',
        ];
    }
}
