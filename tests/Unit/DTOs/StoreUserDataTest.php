<?php

namespace Tests\Unit\DTOs;

use App\DTOs\StoreUserData;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StoreUserDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_from_constructor(): void
    {
        $dto = new StoreUserData(name: 'Ana', email: 'ana@example.com', password: 'secret', profileId: 2);

        $this->assertEquals('Ana', $dto->name);
        $this->assertEquals('ana@example.com', $dto->email);
        $this->assertEquals('secret', $dto->password);
        $this->assertEquals(2, $dto->profileId);
        $this->assertTrue($dto->active);
    }

    #[Test]
    public function it_creates_dto_from_request_and_normalizes_email(): void
    {
        $dto = StoreUserData::fromRequest([
            'name' => '  João  ',
            'email' => '  JOAO@Example.com  ',
            'password' => 'secret',
        ]);

        $this->assertEquals('João', $dto->name);
        $this->assertEquals('joao@example.com', $dto->email);
    }

    #[Test]
    public function it_converts_to_array(): void
    {
        $dto = StoreUserData::fromRequest(['name' => 'Ana', 'email' => 'a@b.pt', 'password' => 'x']);

        $this->assertEquals([
            'name' => 'Ana',
            'email' => 'a@b.pt',
            'password' => 'x',
            'profile_id' => null,
            'active' => true,
        ], $dto->toArray());
    }

    #[Test]
    public function it_rejects_blank_name(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new StoreUserData(name: '', email: 'a@b.pt', password: 'x');
    }

    #[Test]
    public function it_rejects_invalid_email(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new StoreUserData(name: 'Ana', email: 'nope', password: 'x');
    }

    #[Test]
    public function it_rejects_blank_password(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new StoreUserData(name: 'Ana', email: 'a@b.pt', password: '');
    }
}
