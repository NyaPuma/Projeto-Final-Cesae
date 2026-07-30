<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class EquipmentCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'equipment_categories';

    protected $fillable = [
        'name',
        'active',
    ];

    /**
     * Mapeamento de tipos dos atributos (Sintaxe recomendada).
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    /**
     * Uma categoria possui muitos equipamentos.
     * Mantém-se 'category_id' explicitamente para coincidir com a coluna da tabela 'equipments'.
     */
    public function equipments(): HasMany
    {
        return $this->hasMany(Equipment::class, 'category_id');
    }

    /**
     * Scope para filtrar apenas categorias ativas.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }
}
