<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

final class ScheduleTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'scheduled_at' => ['required', 'date', 'after:now'],
            'scheduled_end' => ['nullable', 'date', 'after:scheduled_at'],
        ];
    }
}
