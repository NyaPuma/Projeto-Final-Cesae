<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 */
class UserProfile extends Model
{
    use HasFactory;

    // Define explicitamente o nome da tabela caso o plural do Laravel falhe
    protected $table = 'user_profiles';

    protected $fillable = [
        'name',
    ];

    /**
     * Relação: Um perfil pertence a muitos utilizadores.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'profile_id');
    }
}
