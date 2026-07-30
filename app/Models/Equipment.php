<?php

declare(strict_types=1);

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Equipment extends Model
{
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    /**
     * O plural padrão do Eloquent para "Equipment" é "equipment" (invariável).
     * Definir $table garante o mapeamento correto caso a tabela seja "equipments".
     */
    protected $table = 'equipments';

    protected $fillable = [
        'name',
        'serial',
        'asset_tag',
        'brand',
        'model',
        'manufacturer',
        'purchase_date',
        'warranty_until',
        'status',
        'active',
        'notes',
        'room_id',
        'category_id',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'purchase_date' => 'date',
            'warranty_until' => 'date',
        ];
    }

    /**
     * Categoria à qual o equipamento pertence.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(EquipmentCategory::class);
    }

    /**
     * Sala onde o equipamento está alocado.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Chamados/Tickets associados a este equipamento.
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Scope para filtrar rapidamente apenas equipamentos ativos.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }
}
