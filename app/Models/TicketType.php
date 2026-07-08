<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TicketType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    /**
     * Obtém os estados associados a este tipo de avaria.
     */
    public function statuses(): HasMany
    {
        return $this->hasMany(TicketStatus::class, 'type_id');
    }
}
