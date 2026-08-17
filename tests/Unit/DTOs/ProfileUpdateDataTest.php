<?php

namespace Tests\Unit\DTOs;

use App\DTOs\ProfileUpdateData;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProfileUpdateDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_from_constructor(): void
    {
        $dto = new ProfileUpdateData(name: 'Ana', email: 'ANA@example.com');

        $this->assertEquals('Ana', $dto->name);
        $this->assertEquals('ANA@example.com', $dto->email);
    }

    #[Test]
    public function it_creates_dto_from_request_and_normalizes_email(): void
    {
        $dto = ProfileUpdateData::fromRequest([
            'name' => '  João  ',
            'email' => '  JOAO@Example.com  ',
        ]);

        $this->assertEquals('João', $dto->name);
        $this->assertEquals('joao@example.com', $dto->email);
    }

    #[Test]
    public function it_treats_blank_values_as_null(): void
    {
        $dto = ProfileUpdateData::fromRequest(['name' => '   ', 'email' => '']);

        $this->assertNull($dto->name);
        $this->assertNull($dto->email);
    }

    #[Test]
    public function it_filters_null_fields_in_to_array(): void
    {
        $dto = new ProfileUpdateData(name: 'João');

        $this->assertEquals(['name' => 'João'], $dto->toArray());
    }

    #[Test]
    public function it_detects_whether_changes_exist(): void
    {
        $this->assertTrue((new ProfileUpdateData(name: 'João'))->hasChanges());
        $this->assertFalse((new ProfileUpdateData())->hasChanges());
    }

    #[Test]
    public function it_rejects_invalid_email_format(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ProfileUpdateData(email: 'not-an-email');
    }

    #[Test]
    public function it_rejects_whitespace_only_name(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ProfileUpdateData(name: '   ');
    }
}
