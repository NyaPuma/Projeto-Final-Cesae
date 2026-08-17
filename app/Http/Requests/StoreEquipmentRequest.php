<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreEquipmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Limpa espaços extras do nome e número de série antes da validação.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->filled('name') ? trim((string) $this->name) : $this->name,
            'serial' => $this->filled('serial') ? trim((string) $this->serial) : $this->serial,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'serial' => [
                'required',
                'string',
                'max:255',
                Rule::unique(Equipment::class, 'serial'),
            ],
            'room_id' => ['nullable', 'integer', Rule::exists(Room::class, 'id')],
            'category_id' => ['nullable', 'integer', Rule::exists(EquipmentCategory::class, 'id')],
            'active' => ['sometimes', 'boolean'],
            'asset_tag' => ['nullable', 'string', 'max:100', Rule::unique(Equipment::class, 'asset_tag')],
            'brand' => ['nullable', 'string', 'max:100'],
            'model' => ['nullable', 'string', 'max:100'],
            'manufacturer' => ['nullable', 'string', 'max:100'],
            'purchase_date' => ['nullable', 'date'],
            'warranty_until' => ['nullable', 'date'],
            'status' => ['nullable', Rule::in(['operacional', 'manutenção', 'avariado', 'abatido'])],
            'notes' => ['nullable', 'string'],
        ];
    }

    /**
     * Nomes amigáveis para os campos nas mensagens de validação padrão.
     */
    public function attributes(): array
    {
        return [
            'name' => 'nome do equipamento',
            'serial' => 'número de série',
            'room_id' => 'sala',
            'category_id' => 'categoria',
            'active' => 'status ativo',
            'asset_tag' => 'etiqueta de ativo',
            'brand' => 'marca',
            'model' => 'modelo',
            'manufacturer' => 'fabricante',
            'purchase_date' => 'data de compra',
            'warranty_until' => 'fim de garantia',
            'status' => 'estado operacional',
            'notes' => 'notas',
        ];
    }
}
