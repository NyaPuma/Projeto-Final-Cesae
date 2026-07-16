<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EquipmentCategory extends Model
{
    use HasFactory;

    // Forçamos o nome correto da tabela caso o pluralizador do Laravel falhe
    protected $table = 'equipment_categories';

    protected $fillable = [
        'name',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    // Uma categoria tem muitos equipamentos
    public function equipments(): HasMany
    {
        return $this->hasMany(Equipment::class, 'category_id');
    }
}
