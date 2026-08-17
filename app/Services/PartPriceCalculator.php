<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Part;
use App\Models\TaxRate;

/**
 * Cálculo de preços de peças com IVA configurável.
 *
 * O preço final é sempre calculado dinamicamente a partir da taxa associada:
 * preco_final = preco_custo * (1 + percentagem / 100). Nunca hardcoded.
 */
final class PartPriceCalculator
{
    /**
     * Preço de custo com IVA incluído, a partir da taxa da peça.
     */
    public function priceWithVat(Part $part, ?TaxRate $taxRate = null): float
    {
        $rate = $taxRate ?? $part->taxRate;
        $percent = (float) ($rate?->percent ?? 0);

        return round((float) $part->cost_price * (1 + $percent / 100), 2);
    }

    /**
     * Montante de IVA (diferença entre preço com e sem IVA).
     */
    public function vatAmount(Part $part, ?TaxRate $taxRate = null): float
    {
        return round($this->priceWithVat($part, $taxRate) - (float) $part->cost_price, 2);
    }

    /**
     * Preço de venda com IVA (se aplicável a faturação interna).
     */
    public function salePriceWithVat(Part $part, ?TaxRate $taxRate = null): ?float
    {
        if ($part->sale_price === null) {
            return null;
        }

        $rate = $taxRate ?? $part->taxRate;
        $percent = (float) ($rate?->percent ?? 0);

        return round((float) $part->sale_price * (1 + $percent / 100), 2);
    }
}
