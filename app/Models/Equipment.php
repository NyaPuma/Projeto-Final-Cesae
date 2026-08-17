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
     * Explicit table name mapping.
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
     * Category that the equipment belongs to.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(EquipmentCategory::class);
    }

    /**
     * Room where the equipment is located.
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Maintenance tickets associated with this equipment.
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * Preventive maintenance plans defined for this equipment.
     */
    public function maintenancePlans(): HasMany
    {
        return $this->hasMany(MaintenancePlan::class);
    }

    /**
     * Scope to filter active equipment records.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }
}
