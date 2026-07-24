<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Equipment extends Model
{
    use Auditable;
    use HasFactory;
    use SoftDeletes;

    protected $table = 'equipments';

    protected $fillable = [
        'name',
        'serial',
        'room_id',
        'category_id', // 2. Garante que está no fillable
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    // 3. Relação corrigida para apontar para EquipmentCategory usando a FK 'category_id'
    public function category(): BelongsTo
    {
        return $this->belongsTo(EquipmentCategory::class, 'category_id');
    }

    public function room(): BelongsTo
    {
        return $this->belongsTo(Room::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
