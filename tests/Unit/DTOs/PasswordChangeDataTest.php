<?php

namespace Tests\Unit\DTOs;

use App\DTOs\PasswordChangeData;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PasswordChangeDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_from_constructor(): void
    {
        $dto = new PasswordChangeData(currentPassword: 'antiga', newPassword: 'nova');

        $this->assertEquals('antiga', $dto->currentPassword);
        $this->assertEquals('nova', $dto->newPassword);
    }

    #[Test]
    public function it_creates_dto_from_request(): void
    {
        $dto = PasswordChangeData::fromRequest([
            'current_password' => 'antiga',
            'new_password' => 'nova',
        ]);

        $this->assertEquals('antiga', $dto->currentPassword);
        $this->assertEquals('nova', $dto->newPassword);
    }

    #[Test]
    public function it_converts_to_array(): void
    {
        $dto = PasswordChangeData::fromRequest([
            'current_password' => 'a',
            'new_password' => 'b',
        ]);

        $this->assertEquals([
            'current_password' => 'a',
            'new_password' => 'b',
        ], $dto->toArray());
    }

    #[Test]
    public function it_rejects_empty_current_password(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new PasswordChangeData(currentPassword: '', newPassword: 'nova');
    }

    #[Test]
    public function it_rejects_empty_new_password(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new PasswordChangeData(currentPassword: 'antiga', newPassword: '');
    }

    #[Test]
    public function it_rejects_identical_passwords(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new PasswordChangeData(currentPassword: 'igual', newPassword: 'igual');
    }
}
