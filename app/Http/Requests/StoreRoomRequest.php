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
     * Limpa espaços sobressalentes antes de validar.
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
        ];
    }

    /**
     * Mapeia os nomes dos campos para as mensagens padrão do Laravel.
     */
    public function attributes(): array
    {
        return [
            'name' => 'nome da sala',
            'location' => 'localização',
        ];
    }
}
