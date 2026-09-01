<?php

namespace Tests\Unit\DTOs;

use App\DTOs\ScheduleMaintenanceData;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ScheduleMaintenanceDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_from_constructor(): void
    {
        $dto = new ScheduleMaintenanceData(
            title: 'Revisão',
            equipmentId: 3,
            scheduledAt: '2026-07-01 10:00:00',
            assignedTo: 2,
            description: ' Troca de óleo ',
        );

        $this->assertEquals('Revisão', $dto->title);
        $this->assertEquals(3, $dto->equipmentId);
        $this->assertEquals('2026-07-01 10:00:00', $dto->scheduledAt);
        $this->assertEquals(2, $dto->assignedTo);
        $this->assertEquals(' Troca de óleo ', $dto->description);
    }

    #[Test]
    public function it_creates_dto_from_request(): void
    {
        $dto = ScheduleMaintenanceData::fromRequest([
            'title' => '  Inspeção anual  ',
            'equipment_id' => '4',
            'scheduled_at' => '2026-08-01 09:00:00',
            'assigned_to' => '1',
            'description' => '  Verificação completa  ',
        ]);

        $this->assertEquals('Inspeção anual', $dto->title);
        $this->assertEquals(4, $dto->equipmentId);
        $this->assertEquals('2026-08-01 09:00:00', $dto->scheduledAt);
        $this->assertEquals(1, $dto->assignedTo);
        $this->assertEquals('Verificação completa', $dto->description);
    }

    #[Test]
    public function it_parses_nullable_integer_fields(): void
    {
        $dto = ScheduleMaintenanceData::fromRequest([
            'title' => 'Revisão',
            'equipment_id' => '0',
            'scheduled_at' => '2026-08-01 09:00:00',
            'assigned_to' => 'abc',
        ]);

        $this->assertNull($dto->equipmentId);
        $this->assertNull($dto->assignedTo);
    }

    #[Test]
    public function it_treats_blank_description_as_null(): void
    {
        $dto = ScheduleMaintenanceData::fromRequest([
            'title' => 'Revisão',
            'equipment_id' => '1',
            'scheduled_at' => '2026-08-01 09:00:00',
            'description' => '   ',
        ]);

        $this->assertNull($dto->description);
    }

    #[Test]
    public function it_rejects_blank_title(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ScheduleMaintenanceData(title: '   ', equipmentId: 1, scheduledAt: '2026-08-01');
    }

    #[Test]
    public function it_rejects_missing_equipment(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ScheduleMaintenanceData(title: 'Revisão', equipmentId: null, scheduledAt: '2026-08-01');
    }

    #[Test]
    public function it_rejects_non_positive_equipment_id(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ScheduleMaintenanceData(title: 'Revisão', equipmentId: 0, scheduledAt: '2026-08-01');
    }
}
