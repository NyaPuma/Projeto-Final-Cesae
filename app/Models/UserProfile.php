<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
final class UserProfile extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'user_profiles';

    protected $fillable = [
        'name',
        'description',
        'active',
    ];

    // --- RELAÇÕES ---

    /**
     * Utilizadores associados a este perfil.
     * Manteve-se 'profile_id' explicitamente para coincidir com a coluna da tabela 'users'.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'profile_id');
    }
}
