<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Supplier;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => $this->filled('name') ? trim((string) $this->name) : $this->name,
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:150'],
            'nif' => ['nullable', 'string', 'max:30', Rule::unique(Supplier::class, 'nif')->ignore($this->route('supplier'))],
            'contact' => ['nullable', 'string', 'max:100'],
            'email' => ['nullable', 'email', 'max:150'],
            'address' => ['nullable', 'string'],
            'avg_lead_time_days' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'nif' => \App\Services\LocaleService::taxIdentifierLabel(),
            'contact' => 'contacto',
            'email' => 'email',
            'address' => 'morada',
            'avg_lead_time_days' => 'prazo de entrega médio',
        ];
    }
}
