<?php

namespace App\DTOs;

final readonly class CommentData
{
    public function __construct(
        public string $content,
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            content: $data['content'],
        );
    }
}
