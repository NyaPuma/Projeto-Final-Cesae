<?php

namespace Tests\Unit\DTOs;

use App\DTOs\CreateTicketData;
use App\Enums\TicketPriorityEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateTicketDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_from_constructor(): void
    {
        $dto = new CreateTicketData(
            title: 'Test Ticket',
            description: 'Test Description',
            priority: TicketPriorityEnum::High,
            equipmentId: 1,
            roomId: 2
        );

        $this->assertEquals('Test Ticket', $dto->title);
        $this->assertEquals('Test Description', $dto->description);
        $this->assertEquals(TicketPriorityEnum::High, $dto->priority);
        $this->assertEquals(1, $dto->equipmentId);
        $this->assertEquals(2, $dto->roomId);
    }

    #[Test]
    public function it_creates_dto_from_request(): void
    {
        $data = [
            'title' => 'Test Ticket',
            'description' => 'Test Description',
            'priority' => 'alta',
            'equipment_id' => 1,
            'room_id' => 2,
        ];

        $dto = CreateTicketData::fromRequest($data);

        $this->assertEquals('Test Ticket', $dto->title);
        $this->assertEquals('Test Description', $dto->description);
        $this->assertEquals(TicketPriorityEnum::High, $dto->priority);
        $this->assertEquals(1, $dto->equipmentId);
        $this->assertEquals(2, $dto->roomId);
    }

    #[Test]
    public function it_creates_dto_without_optional_fields(): void
    {
        $dto = new CreateTicketData(
            title: 'Test Ticket',
            description: 'Test Description',
            priority: TicketPriorityEnum::Medium
        );

        $this->assertNull($dto->equipmentId);
        $this->assertNull($dto->roomId);
    }

    #[Test]
    public function it_creates_dto_from_request_without_optional_fields(): void
    {
        $data = [
            'title' => 'Test Ticket',
            'description' => 'Test Description',
            'priority' => 'média',
        ];

        $dto = CreateTicketData::fromRequest($data);

        $this->assertNull($dto->equipmentId);
        $this->assertNull($dto->roomId);
    }

    #[Test]
    public function it_is_readonly(): void
    {
        $dto = new CreateTicketData(
            title: 'Test Ticket',
            description: 'Test Description',
            priority: TicketPriorityEnum::Medium
        );

        $this->assertInstanceOf(\ReflectionClass::class, new \ReflectionClass($dto));
        $this->assertTrue((new \ReflectionClass($dto))->isReadOnly());
    }
}
