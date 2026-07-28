<?php

namespace App\Models;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property-read UserProfile|null $profile
 * @property-read int $tickets_ativos
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /** @var string */
    protected $table = 'users';

    /** @var list<string> */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_id',
        'active',
        'api_token',
        'token_created_at',
        'remember_token',
    ];

    /** @var list<string> */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'token_created_at' => 'datetime',
        'active' => 'boolean',
    ];

    public const ROLE_USER = UserRoleEnum::User->value;

    public const ROLE_TECHNICIAN = UserRoleEnum::Technician->value;

    public const ROLE_ADMIN = UserRoleEnum::Admin->value;

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }

    public function assignedTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }

    public function profile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class, 'profile_id');
    }

    public function isAdmin(): bool
    {
        return $this->profile?->name === UserRoleEnum::Admin->value;
    }

    public function isTechnician(): bool
    {
        return $this->profile?->name === UserRoleEnum::Technician->value;
    }

    public function isCommonUser(): bool
    {
        return $this->profile?->name === UserRoleEnum::User->value;
    }

    public function isCommon(): bool
    {
        return $this->isCommonUser();
    }

    public static function hashToken(string $token): string
    {
        return hash_hmac('sha256', $token, config('app.key'));
    }
}
