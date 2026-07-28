<?php

namespace App\Enums;

enum FileTypeEnum: string
{
    case Image = 'image';
    case Document = 'document';
    case Video = 'video';
    case Audio = 'audio';
    case Other = 'other';

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }

    public static function fromMimeType(string $mimeType): self
    {
        return match (true) {
            str_starts_with($mimeType, 'image/') => self::Image,
            str_starts_with($mimeType, 'video/') => self::Video,
            str_starts_with($mimeType, 'audio/') => self::Audio,
            in_array($mimeType, ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']) => self::Document,
            default => self::Other,
        };
    }
}
