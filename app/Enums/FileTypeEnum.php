<?php

namespace App\Enums;

enum FileTypeEnum: string
{
    case Image = 'image';
    case Document = 'document';
    case Video = 'video';
    case Audio = 'audio';
    case Other = 'other';

    /**
     * Retorna todos os valores raw do Enum num array simples.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Retorna a descrição legível em Português para a UI.
     */
    public function label(): string
    {
        return match ($this) {
            self::Image => 'Imagem',
            self::Document => 'Documento',
            self::Video => 'Vídeo',
            self::Audio => 'Áudio',
            self::Other => 'Outro',
        };
    }

    /**
     * Ícone indicativo para representação visual no frontend (ex: Heroicons).
     */
    public function icon(): string
    {
        return match ($this) {
            self::Image => 'heroicon-o-photo',
            self::Document => 'heroicon-o-document-text',
            self::Video => 'heroicon-o-film',
            self::Audio => 'heroicon-o-speaker-wave',
            self::Other => 'heroicon-o-paper-clip',
        };
    }

    /**
     * Identifica o FileTypeEnum a partir do MIME type.
     */
    public static function fromMimeType(string $mimeType): self
    {
        $mime = mb_strtolower(trim($mimeType));

        if (str_starts_with($mime, 'image/')) {
            return self::Image;
        }

        if (str_starts_with($mime, 'video/')) {
            return self::Video;
        }

        if (str_starts_with($mime, 'audio/')) {
            return self::Audio;
        }

        if (str_starts_with($mime, 'text/') || self::isDocumentMimeType($mime)) {
            return self::Document;
        }

        return self::Other;
    }

    /**
     * Lista abrangente de MIME types considerados documentos (PDF, Office, OpenDocument, RTF, CSV, etc.).
     */
    private static function isDocumentMimeType(string $mime): bool
    {
        $documentMimes = [
            // PDF
            'application/pdf',
            // Microsoft Word
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            // Microsoft Excel
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            // Microsoft PowerPoint
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
            // OpenDocument Formats
            'application/vnd.oasis.opendocument.text',
            'application/vnd.oasis.opendocument.spreadsheet',
            'application/vnd.oasis.opendocument.presentation',
            // Outros documentos de texto/dados
            'application/rtf',
            'application/csv',
            'application/json',
            'application/xml',
        ];

        return in_array($mime, $documentMimes, true);
    }

    /**
     * Tenta converter um valor genérico (string ou Enum) de forma segura.
     */
    public static function normalize(mixed $value): ?self
    {
        if ($value instanceof self) {
            return $value;
        }

        if (!is_string($value)) {
            return null;
        }

        return self::tryFrom(mb_strtolower(trim($value)));
    }
}
