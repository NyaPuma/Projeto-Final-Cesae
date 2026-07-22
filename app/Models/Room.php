<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use Auditable;
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function equipments(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
