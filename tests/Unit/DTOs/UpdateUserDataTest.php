<?php

namespace Tests\Unit\DTOs;

use App\DTOs\UpdateUserData;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateUserDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_from_constructor(): void
    {
        $dto = new UpdateUserData(name: 'Ana', active: false);

        $this->assertEquals('Ana', $dto->name);
        $this->assertFalse($dto->active);
    }

    #[Test]
    public function it_creates_dto_from_request_and_normalizes_email(): void
    {
        $dto = UpdateUserData::fromRequest([
            'name' => '  João  ',
            'email' => '  JOAO@Example.com  ',
            'password' => 'nova-secret',
        ]);

        $this->assertEquals('João', $dto->name);
        $this->assertEquals('joao@example.com', $dto->email);
        $this->assertEquals('nova-secret', $dto->password);
        $this->assertTrue($dto->hasPassword());
    }

    #[Test]
    public function it_treats_blank_password_as_null(): void
    {
        $dto = UpdateUserData::fromRequest(['password' => '']);

        $this->assertNull($dto->password);
        $this->assertFalse($dto->hasPassword());
    }

    #[Test]
    public function it_filters_null_fields_and_excludes_password_in_to_array(): void
    {
        $dto = UpdateUserData::fromRequest(['name' => 'Ana', 'password' => 'secret']);

        $this->assertEquals(['name' => 'Ana'], $dto->toArray());
    }

    #[Test]
    public function it_detects_whether_updates_exist(): void
    {
        $this->assertTrue((new UpdateUserData(password: 'secret'))->hasUpdates());
        $this->assertFalse((new UpdateUserData)->hasUpdates());
    }

    #[Test]
    public function it_rejects_invalid_email(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new UpdateUserData(email: 'nope');
    }

    #[Test]
    public function it_rejects_non_positive_profile_id(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new UpdateUserData(profileId: 0);
    }
}
