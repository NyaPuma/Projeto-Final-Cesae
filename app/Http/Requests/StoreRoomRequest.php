<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Trims whitespace before validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->filled('name') ? trim((string) $this->name) : $this->name,
            'location' => $this->filled('location') ? trim((string) $this->location) : $this->location,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Room::class, 'name'),
            ],
            'location' => ['nullable', 'string', 'max:255'],
            'code' => ['nullable', 'string', 'max:50', Rule::unique(Room::class, 'code')],
            'building' => ['nullable', 'string', 'max:100'],
            'floor' => ['nullable', 'string', 'max:50'],
            'capacity' => ['nullable', 'integer', 'min:0', 'max:65535'],
            'description' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'active' => ['sometimes', 'boolean'],
        ];
    }

    /**
     * Maps field names to Laravel's default messages.
     */
    public function attributes(): array
    {
        return [
            'name' => 'nome da sala',
            'location' => 'localização',
            'code' => 'código da sala',
            'building' => 'edifício',
            'floor' => 'piso',
            'capacity' => 'capacidade',
            'description' => 'descrição',
            'notes' => 'notas internas',
            'active' => 'estado ativo',
        ];
    }
}
