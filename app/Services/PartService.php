<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Part;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

final class PartService
{
    /**
     * Listagem paginada de peças com pesquisa e filtros.
     *
     * @param  string|null  $search  pesquisa por sku, nome, marca ou referência
     * @param  string|null  $status  'low' | 'out' | 'all' | '' | null
     * @param  int|null  $categoryId  filtro por categoria
     */
    public function listPaginated(
        ?string $search = null,
        ?string $status = null,
        ?int $categoryId = null,
        int $perPage = 15,
    ): LengthAwarePaginator {
        $query = Part::query()->with(['category', 'taxRate']);

        if ($search !== null && $search !== '') {
            $safeSearch = str_replace(['%', '_'], ['\%', '\_'], $search);
            $query->where(function ($sub) use ($safeSearch): void {
                $sub->where('name', 'like', "%{$safeSearch}%")
                    ->orWhere('sku', 'like', "%{$safeSearch}%")
                    ->orWhere('brand', 'like', "%{$safeSearch}%")
                    ->orWhere('manufacturer_ref', 'like', "%{$safeSearch}%");
            });
        }

        if ($status === 'low') {
            $query->lowStock();
        } elseif ($status === 'out') {
            $query->outOfStock();
        }

        if ($categoryId !== null && $categoryId > 0) {
            $query->where('part_category_id', $categoryId);
        }

        return $query->orderBy('name')->paginate($perPage);
    }
}
