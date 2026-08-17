<?php

namespace Tests\Unit\Enums;

use App\Enums\FileTypeEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FileTypeEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_values(): void
    {
        $this->assertEquals('image', FileTypeEnum::Image->value);
        $this->assertEquals('document', FileTypeEnum::Document->value);
        $this->assertEquals('video', FileTypeEnum::Video->value);
        $this->assertEquals('audio', FileTypeEnum::Audio->value);
        $this->assertEquals('other', FileTypeEnum::Other->value);
    }

    #[Test]
    public function it_returns_labels_in_portuguese(): void
    {
        $this->assertEquals('Imagem', FileTypeEnum::Image->label());
        $this->assertEquals('Documento', FileTypeEnum::Document->label());
        $this->assertEquals('Vídeo', FileTypeEnum::Video->label());
        $this->assertEquals('Áudio', FileTypeEnum::Audio->label());
        $this->assertEquals('Outro', FileTypeEnum::Other->label());
    }

    #[Test]
    public function it_returns_icons(): void
    {
        $this->assertEquals('heroicon-o-photo', FileTypeEnum::Image->icon());
        $this->assertEquals('heroicon-o-document-text', FileTypeEnum::Document->icon());
        $this->assertEquals('heroicon-o-film', FileTypeEnum::Video->icon());
        $this->assertEquals('heroicon-o-speaker-wave', FileTypeEnum::Audio->icon());
        $this->assertEquals('heroicon-o-paper-clip', FileTypeEnum::Other->icon());
    }

    #[Test]
    public function it_detects_type_from_mime(): void
    {
        $this->assertEquals(FileTypeEnum::Image, FileTypeEnum::fromMimeType('image/png'));
        $this->assertEquals(FileTypeEnum::Video, FileTypeEnum::fromMimeType('video/mp4'));
        $this->assertEquals(FileTypeEnum::Audio, FileTypeEnum::fromMimeType('audio/mpeg'));
        $this->assertEquals(FileTypeEnum::Document, FileTypeEnum::fromMimeType('application/pdf'));
        $this->assertEquals(FileTypeEnum::Document, FileTypeEnum::fromMimeType('text/plain'));
        $this->assertEquals(FileTypeEnum::Document, FileTypeEnum::fromMimeType('application/vnd.openxmlformats-officedocument.wordprocessingml.document'));
        $this->assertEquals(FileTypeEnum::Other, FileTypeEnum::fromMimeType('application/octet-stream'));
    }

    #[Test]
    public function it_normalizes_values_case_insensitively(): void
    {
        $this->assertEquals(FileTypeEnum::Image, FileTypeEnum::normalize('IMAGE'));
        $this->assertNull(FileTypeEnum::normalize('unknown'));
    }

    #[Test]
    public function it_returns_all_values(): void
    {
        $this->assertCount(5, FileTypeEnum::values());
    }
}
