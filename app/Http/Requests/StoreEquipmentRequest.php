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
            'room_id' => ['nullable', 'integer', 'exists:rooms,id'],
            'category_id' => ['nullable', 'integer', 'exists:equipment_categories,id'],
        ];
    }
}
