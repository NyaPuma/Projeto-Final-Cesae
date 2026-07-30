<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;

final class TicketAttachment extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'original_name',
        'file_name',
        'path',
        'disk',
        'extension',
        'mime_type',
        'size',
        'checksum',
        'description',
    ];

    /**
     * Mapeamento de tipos dos atributos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'size' => 'integer',
        ];
    }

    /**
     * Eventos automatizados do modelo.
     */
    protected static function booted(): void
    {
        // Garante que o ficheiro físico é removido do Storage ao apagar o registo na BD
        static::deleting(static function (self $attachment): void {
            if ($attachment->path && Storage::exists($attachment->path)) {
                Storage::delete($attachment->path);
            }
        });
    }

    // --- RELAÇÕES ---

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // --- ACCESSORS ---

    /**
     * Obtém o URL direto do ficheiro para download ou visualização.
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn (): string => Storage::url($this->path)
        );
    }

    /**
     * Retorna o tamanho do ficheiro formatado em KB, MB ou GB.
     */
    protected function formattedSize(): Attribute
    {
        return Attribute::make(
            get: fn (): string => Number::fileSize($this->size)
        );
    }

    /**
     * Verifica se o anexo é uma imagem.
     */
    protected function isImage(): Attribute
    {
        return Attribute::make(
            get: fn (): bool => str_starts_with($this->mime_type ?? '', 'image/')
        );
    }
}
