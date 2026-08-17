<?php

namespace Tests\Unit\DTOs;

use App\DTOs\AssignTechnicianData;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AssignTechnicianDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_from_constructor(): void
    {
        $dto = new AssignTechnicianData(technicianId: 5);

        $this->assertEquals(5, $dto->technicianId);
    }

    #[Test]
    public function it_creates_dto_from_request(): void
    {
        $dto = AssignTechnicianData::fromRequest(['technician_id' => '7']);

        $this->assertEquals(7, $dto->technicianId);
    }

    #[Test]
    public function it_treats_invalid_ids_as_null(): void
    {
        $dto = AssignTechnicianData::fromRequest(['technician_id' => '']);

        $this->assertNull($dto->technicianId);
    }

    #[Test]
    public function it_converts_to_array(): void
    {
        $dto = AssignTechnicianData::fromRequest(['technician_id' => 3]);

        $this->assertEquals(['technician_id' => 3], $dto->toArray());
    }

    #[Test]
    public function it_rejects_non_positive_technician_id(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new AssignTechnicianData(technicianId: 0);
    }
}
