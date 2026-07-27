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
}
