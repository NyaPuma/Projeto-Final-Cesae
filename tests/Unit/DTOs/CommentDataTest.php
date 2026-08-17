<?php

namespace Tests\Unit\DTOs;

use App\DTOs\CommentData;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CommentDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_from_constructor(): void
    {
        $dto = new CommentData(content: 'Comentário de teste');

        $this->assertEquals('Comentário de teste', $dto->content);
    }

    #[Test]
    public function it_creates_dto_from_request_and_trims_content(): void
    {
        $dto = CommentData::fromRequest(['content' => '  texto com espaços  ']);

        $this->assertEquals('texto com espaços', $dto->content);
    }

    #[Test]
    public function it_converts_to_array(): void
    {
        $dto = CommentData::fromRequest(['content' => 'conteúdo']);

        $this->assertEquals(['content' => 'conteúdo'], $dto->toArray());
    }

    #[Test]
    public function it_rejects_blank_content(): void
    {
        $this->expectException(InvalidArgumentException::class);

        CommentData::fromRequest(['content' => '   ']);
    }
}
