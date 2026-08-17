<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\PartUnitOfMeasureEnum;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use InvalidArgumentException;

final class Part extends Model
{
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'sku',
        'name',
        'description',
        'brand',
        'manufacturer_ref',
        'part_category_id',
        'unit_of_measure',
        'cost_price',
        'tax_rate_id',
        'sale_price',
        'current_stock',
        'min_stock',
        'max_stock',
        'location',
        'photo',
        'active',
        'technical_notes',
    ];

    protected function casts(): array
    {
        return [
            'cost_price' => 'decimal:2',
            'sale_price' => 'decimal:2',
            'current_stock' => 'integer',
            'min_stock' => 'integer',
            'max_stock' => 'integer',
            'active' => 'boolean',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(PartCategory::class, 'part_category_id');
    }

    public function taxRate(): BelongsTo
    {
        return $this->belongsTo(TaxRate::class, 'tax_rate_id');
    }

    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(Supplier::class, 'part_supplier')
            ->withPivot(['price', 'supplier_ref', 'lead_time_days'])
            ->withTimestamps();
    }

    public function movements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }

    public function maintenancePlans(): BelongsToMany
    {
        return $this->belongsToMany(MaintenancePlan::class, 'maintenance_plan_part')
            ->withPivot(['expected_quantity'])
            ->withTimestamps();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    /**
     * Peças cujo stock atual está igual ou abaixo do mínimo.
     */
    public function scopeLowStock(Builder $query): Builder
    {
        return $query
            ->where('active', true)
            ->whereColumn('current_stock', '<=', 'min_stock');
    }

    /**
     * Peças totalmente esgotadas.
     */
    public function scopeOutOfStock(Builder $query): Builder
    {
        return $query->where('current_stock', 0);
    }

    /**
     * Preço de custo com IVA, calculado dinamicamente a partir da taxa.
     */
    public function priceWithVat(): float
    {
        $percent = (float) $this->taxRate?->percent;

        return round((float) $this->cost_price * (1 + $percent / 100), 2);
    }

    /**
     * Valor total em stock (stock_atual * preço de custo).
     */
    public function stockValue(): float
    {
        return round((float) $this->current_stock * (float) $this->cost_price, 2);
    }

    public function isLowStock(): bool
    {
        return (int) $this->current_stock <= (int) $this->min_stock;
    }

    /**
     * Garante que a unidade de medida é um valor válido do enum.
     */
    public function validateUnitOfMeasure(string $unit): void
    {
        if (PartUnitOfMeasureEnum::tryFrom($unit) === null) {
            throw new InvalidArgumentException("Unidade de medida inválida: {$unit}");
        }
    }
}
