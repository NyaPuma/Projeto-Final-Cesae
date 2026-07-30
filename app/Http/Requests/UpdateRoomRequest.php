<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateRoomRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Limpa espaços sobressalentes nos dados enviados antes da validação.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('name')) {
            $this->merge([
                'name' => $this->filled('name') ? trim((string) $this->name) : $this->name,
            ]);
        }

        if ($this->has('location')) {
            $this->merge([
                'location' => $this->filled('location') ? trim((string) $this->location) : $this->location,
            ]);
        }
    }

    public function rules(): array
    {
        /** @var Room|int|string|null $room */
        $room = $this->route('room') ?? $this->route('id');

        return [
            'name' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique(Room::class, 'name')->ignore($room),
            ],
            'location' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Nomes amigáveis dos atributos para as mensagens de erro do Laravel.
     */
    public function attributes(): array
    {
        return [
            'name' => 'nome da sala',
            'location' => 'localização',
        ];
    }
}
