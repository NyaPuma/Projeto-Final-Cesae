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
     * Attribute type casting.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'size' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (self $attachment): void {
            if ($attachment->original_name === null) {
                $attachment->original_name = $attachment->file_name ?? 'file_' . uniqid();
            }
        });

        // Ensure physical file is deleted from Storage on model deletion
        static::deleting(static function (self $attachment): void {
            $disk = $attachment->disk ?: 'public';
            if ($attachment->path && Storage::disk($disk)->exists($attachment->path)) {
                Storage::disk($disk)->delete($attachment->path);
            }
        });
    }

    // --- RELATIONSHIPS ---

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
     * Direct URL for file download or display.
     */
    protected function url(): Attribute
    {
        return Attribute::make(
            get: fn (): string => Storage::disk($this->disk ?: 'public')->url($this->path)
        );
    }

    /**
     * Formatted file size string (KB, MB, GB).
     */
    protected function formattedSize(): Attribute
    {
        return Attribute::make(
            get: fn (): string => Number::fileSize($this->size)
        );
    }

    /**
     * Check if attachment is an image.
     */
    protected function isImage(): Attribute
    {
        return Attribute::make(
            get: fn (): bool => str_starts_with($this->mime_type ?? '', 'image/')
        );
    }
}
