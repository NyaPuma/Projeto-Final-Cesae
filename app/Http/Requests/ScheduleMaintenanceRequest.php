<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Equipment;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class ScheduleMaintenanceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() ?? false;
    }

    /**
     * Limpa espaços sobressalentes nos textos antes da validação.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'title' => $this->filled('title') ? trim((string) $this->title) : $this->title,
            'description' => $this->filled('description') ? trim((string) $this->description) : null,
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'equipment_id' => ['required', 'integer', Rule::exists(Equipment::class, 'id')],
            'scheduled_at' => ['required', 'date'],
            'assigned_to' => ['nullable', 'integer', Rule::exists(User::class, 'id')],
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'título da intervenção',
            'equipment_id' => 'equipamento',
            'scheduled_at' => 'data e hora',
            'assigned_to' => 'técnico',
        ];
    }
}
