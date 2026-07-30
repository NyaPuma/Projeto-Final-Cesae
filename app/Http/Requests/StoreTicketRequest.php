<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\TicketPriorityEnum;
use App\Models\Equipment;
use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreTicketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Limpa espaços sobressalentes nos textos antes da validação.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'title' => $this->filled('title') ? trim((string) $this->title) : $this->title,
            'description' => $this->filled('description') ? trim((string) $this->description) : $this->description,
        ]);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:5000'],
            'priority' => ['required', Rule::enum(TicketPriorityEnum::class)],
            'equipment_id' => ['nullable', 'integer', Rule::exists(Equipment::class, 'id')],
            'room_id' => ['nullable', 'integer', Rule::exists(Room::class, 'id')],
        ];
    }

    /**
     * Nomes amigáveis para as mensagens de erro padrão.
     */
    public function attributes(): array
    {
        return [
            'title' => 'título',
            'description' => 'descrição',
            'priority' => 'prioridade',
            'equipment_id' => 'equipamento',
            'room_id' => 'sala',
        ];
    }
}
