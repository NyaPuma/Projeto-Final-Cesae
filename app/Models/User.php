<?php

namespace App\Models;

use App\Models\Ticket;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property-read \App\Models\UserProfile|null $profile
 * @property-read int $tickets_ativos
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

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
        'remember_token',
    ];

    /** @var list<string> */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token',
        '_tokens',
        '_password_hash',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active'            => 'boolean',
    ];

    // Constantes de Roles - mapeadas para os nomes dos perfis
    public const ROLE_USER       = 'user';
    public const ROLE_TECHNICIAN = 'technician';
    public const ROLE_ADMIN      = 'admin';

    /**
     * Tickets criados pelo utilizador.
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }

    /**
     * Tickets atribuídos ao utilizador (caso seja técnico).
     */
    public function assignedTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'assigned_to');
    }

    /**
     * Perfil associado ao utilizador.
     */
    public function profile(): BelongsTo
    {
        return $this->belongsTo(UserProfile::class, 'profile_id');
    }

    /**
     * Verifica se o utilizador é Administrador.
     */
    public function isAdmin(): bool
    {
        return $this->profile?->name === self::ROLE_ADMIN;
    }

    /**
     * Verifica se o utilizador é Técnico.
     */
    public function isTechnician(): bool
    {
        return $this->profile?->name === self::ROLE_TECHNICIAN;
    }

    /**
     * Verifica se o utilizador é Utilizador Comum.
     */
    public function isCommonUser(): bool
    {
        return $this->profile?->name === self::ROLE_USER;
    }

    /**
     * Alias de isCommonUser() – utilizado nos controllers para verificar se o utilizador não tem papel elevado.
     */
    public function isCommon(): bool
    {
        return $this->isCommonUser();
    }

    /**
     * Obtém todas as constantes de roles disponíveis.
     */
    public static function getAvailableRoles(): array
    {
        return [self::ROLE_USER, self::ROLE_TECHNICIAN, self::ROLE_ADMIN];
    }

    /**
     * Verifica se um nome de perfil pertence às roles válidas do sistema.
     */
    public static function isValidProfile(string $profileName): bool
    {
        return in_array($profileName, self::getAvailableRoles(), true);
    }

    /**
     * Registo dos Model Events do Laravel.
     */
    protected static function booted(): void
    {
        static::creating(function (User $user) {
            self::ensureValidProfile($user);
        });

        static::updating(function (User $user) {
            self::ensureValidProfile($user);
        });
    }

    /**
     * Garante centralizadamente que o utilizador possui um perfil válido antes de salvar.
     */
    private static function ensureValidProfile(User $user): void
    {
        $profileName = $user->profile->name ?? '';

        if (!$user->profile_id || !self::isValidProfile($profileName)) {
            $defaultRole = self::ROLE_USER;

            // Procura pelo perfil padrão ou cria-o atomicamente caso não exista
            $existingProfile = UserProfile::firstOrCreate(['name' => $defaultRole]);

            $user->profile_id = $existingProfile->id;
        }
    }
}