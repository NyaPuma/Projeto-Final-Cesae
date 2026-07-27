<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateEquipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $equipmentId = $this->route('id');

        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'serial' => ['sometimes', 'string', 'max:255', "unique:equipments,serial,{$equipmentId}"],
            'room_id' => ['nullable', 'integer', 'exists:rooms,id'],
            'category_id' => ['nullable', 'integer', 'exists:equipment_categories,id'],
            'active' => ['sometimes', 'boolean'],
        ];
    }
}
