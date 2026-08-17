<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class MaintenancePlan extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'equipment_id',
        'name',
        'interval_type',
        'interval_value',
        'description',
        'active',
    ];

    protected function casts(): array
    {
        return [
            'interval_value' => 'integer',
            'active' => 'boolean',
        ];
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    public function parts(): BelongsToMany
    {
        return $this->belongsToMany(Part::class, 'maintenance_plan_part')
            ->withPivot(['expected_quantity'])
            ->withTimestamps();
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }
}
