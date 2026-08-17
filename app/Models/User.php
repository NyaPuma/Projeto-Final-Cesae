<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Builder;
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
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';

    /** @var list<string> */
    protected $fillable = [
        'name',
        'email',
        'locale',
        'password',
        'profile_id',
        'active',
        'api_token',
        'token_created_at',
        'remember_token',
        'avatar_path',
        'avatar_disk',
        'email_verified_at',
        'password_changed_at',
        'last_login_at',
        'last_login_ip',
        'login_attempts',
        'locked_until',
    ];

    /** @var list<string> */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'token_created_at' => 'datetime',
            'password_changed_at' => 'datetime',
            'last_login_at' => 'datetime',
            'locked_until' => 'datetime',
            'active' => 'boolean',
            'login_attempts' => 'integer',
            'password' => 'hashed',
        ];
    }

    // --- MÉTODOS DE ROLES / PERFIS ---

    public static function getAvailableRoles(): array
    {
        return array_column(UserRoleEnum::cases(), 'value');
    }

    public static function isValidProfile(string $name): bool
    {
        return UserRoleEnum::tryFrom($name) !== null;
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



    // --- RELAÇÕES ---

    /**
     * Chamados/Tickets criados pelo utilizador.
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }

    /**
     * Chamados/Tickets atribuídos ao utilizador (técnico).
     */
    public function assignedTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }

    /**
     * Perfil / Função do utilizador (Admin, Técnico, Utilizador).
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class, 'profile_id');
    }

    // --- SCOPES ---

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    public function scopeTechnicians(Builder $query): Builder
    {
        return $query->whereHas('profile', static function (Builder $q): void {
            $q->where('name', UserRoleEnum::Technician->value);
        });
    }

    // --- HELPERS DA APLICAÇÃO ---

    /**
     * Gera uma hash HMAC SHA256 do token com a chave da aplicação.
     */
    public static function hashToken(string $token): string
    {
        return hash_hmac('sha256', $token, (string) config('app.key'));
    }
}
