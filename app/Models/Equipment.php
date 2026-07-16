<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Room;
use App\Models\Ticket;
use App\Models\EquipmentCategory; // 1. Importa o novo model
use App\Traits\Auditable;

class Equipment extends Model
{
    use HasFactory;
    use Auditable;

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
