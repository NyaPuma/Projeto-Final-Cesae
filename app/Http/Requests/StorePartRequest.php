<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Enums\PartUnitOfMeasureEnum;
use App\Models\Part;
use App\Models\PartCategory;
use App\Models\TaxRate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StorePartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'sku' => $this->filled('sku') ? trim((string) $this->sku) : $this->sku,
            'name' => $this->filled('name') ? trim((string) $this->name) : $this->name,
        ]);
    }

    public function rules(): array
    {
        return [
            'sku' => ['required', 'string', 'max:100', Rule::unique(Part::class, 'sku')],
            'name' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string'],
            'brand' => ['nullable', 'string', 'max:100'],
            'manufacturer_ref' => ['nullable', 'string', 'max:100'],
            'part_category_id' => ['nullable', 'integer', Rule::exists(PartCategory::class, 'id')],
            'unit_of_measure' => ['required', Rule::in(PartUnitOfMeasureEnum::values())],
            'cost_price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'tax_rate_id' => ['nullable', 'integer', Rule::exists(TaxRate::class, 'id')],
            'sale_price' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
            'current_stock' => ['required', 'integer', 'min:0'],
            'min_stock' => ['required', 'integer', 'min:0'],
            'max_stock' => ['nullable', 'integer', 'gte:min_stock'],
            'location' => ['nullable', 'string', 'max:150'],
            'photo' => ['nullable', 'string', 'max:255'],
            'active' => ['sometimes', 'boolean'],
            'technical_notes' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'sku' => 'código (SKU)',
            'name' => 'nome',
            'description' => 'descrição',
            'brand' => 'marca',
            'manufacturer_ref' => 'referência do fabricante',
            'part_category_id' => 'categoria',
            'unit_of_measure' => 'unidade de medida',
            'cost_price' => 'preço de custo',
            'tax_rate_id' => 'taxa de IVA',
            'sale_price' => 'preço de venda',
            'current_stock' => 'stock atual',
            'min_stock' => 'stock mínimo',
            'max_stock' => 'stock máximo',
            'location' => 'localização',
            'photo' => 'fotografia',
            'active' => 'ativo',
            'technical_notes' => 'notas técnicas',
        ];
    }
}
