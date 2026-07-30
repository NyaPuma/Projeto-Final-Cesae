<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

final class SubmitBudgetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'estimated_budget' => ['required', 'numeric', 'min:0.01'],
            'budget_details' => ['nullable', 'array', 'min:1'],
            'budget_details.*.description' => ['required', 'string', 'max:255'],
            'budget_details.*.type' => ['required', 'string', Rule::in(['material', 'labor'])],

            // Validação condicional para itens do tipo 'material'
            'budget_details.*.quantity' => ['required_if:budget_details.*.type,material', 'nullable', 'numeric', 'min:0.01'],
            'budget_details.*.unit_price' => ['required_if:budget_details.*.type,material', 'nullable', 'numeric', 'min:0'],

            // Validação condicional para itens do tipo 'labor' (mão de obra)
            'budget_details.*.hours' => ['required_if:budget_details.*.type,labor', 'nullable', 'numeric', 'min:0.1'],
            'budget_details.*.hourly_rate' => ['required_if:budget_details.*.type,labor', 'nullable', 'numeric', 'min:0'],
        ];
    }

    /**
     * Valida se a soma dos itens individuais bate com o valor total estimado.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if ($validator->errors()->isNotEmpty()) {
                    return;
                }

                $details = $this->input('budget_details');
                if (! is_array($details) || empty($details)) {
                    return;
                }

                $calculatedTotal = array_reduce(
                    $details,
                    function (float $acc, array $item) {
                        $type = $item['type'] ?? null;

                        if ($type === 'material') {
                            return $acc + ((float) ($item['quantity'] ?? 0) * (float) ($item['unit_price'] ?? 0));
                        }

                        if ($type === 'labor') {
                            return $acc + ((float) ($item['hours'] ?? 0) * (float) ($item['hourly_rate'] ?? 0));
                        }

                        return $acc;
                    },
                    0.0
                );

                $estimatedBudget = (float) ($this->input('estimated_budget') ?? $this->input('estimatedBudget'));

                if (abs($calculatedTotal - $estimatedBudget) > 0.01) {
                    $validator->errors()->add(
                        'estimated_budget',
                        'O valor total estimado não corresponde à soma dos detalhes do orçamento.'
                    );
                }
            },
        ];
    }

    /**
     * Mapeamento de atributos para mensagens de erro legíveis.
     */
    public function attributes(): array
    {
        return [
            'estimated_budget' => 'orçamento estimado',
            'estimatedBudget' => 'orçamento estimado',
            'budget_details' => 'detalhes do orçamento',
            'budget_details.*.description' => 'descrição do item',
            'budget_details.*.type' => 'tipo do item',
            'budget_details.*.quantity' => 'quantidade',
            'budget_details.*.unit_price' => 'preço unitário',
            'budget_details.*.hours' => 'horas de trabalho',
            'budget_details.*.hourly_rate' => 'valor por hora',
        ];
    }
}
