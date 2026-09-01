<?php

namespace Tests\Unit\DTOs;

use App\DTOs\TicketFilters;
use App\Enums\TicketPriorityEnum;
use Carbon\CarbonImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketFiltersTest extends TestCase
{
    #[Test]
    public function it_creates_empty_filters(): void
    {
        $dto = new TicketFilters;

        $this->assertFalse($dto->hasFilters());
        $this->assertEquals([], $dto->toArray());
    }

    #[Test]
    public function it_creates_filters_from_request(): void
    {
        $dto = TicketFilters::fromRequest([
            'q' => '  impressora  ',
            'priority' => 'alta',
            'status' => 'aberta',
            'date_from' => '2026-07-01',
            'date_to' => '2026-07-31',
            'user_id' => '5',
            'technician_id' => '3',
            'equipment_id' => '1',
            'room_id' => '2',
        ]);

        $this->assertEquals('impressora', $dto->query);
        $this->assertEquals(TicketPriorityEnum::High, $dto->priority);
        $this->assertEquals('aberta', $dto->status);
        $this->assertInstanceOf(CarbonImmutable::class, $dto->dateFrom);
        $this->assertEquals('2026-07-01', $dto->dateFrom->toDateString());
        $this->assertEquals(5, $dto->userId);
        $this->assertEquals(3, $dto->technicianId);
        $this->assertEquals(1, $dto->equipmentId);
        $this->assertEquals(2, $dto->roomId);
        $this->assertTrue($dto->hasFilters());
    }

    #[Test]
    public function it_ignores_blank_filters(): void
    {
        $dto = TicketFilters::fromRequest(['q' => '   ', 'priority' => '', 'user_id' => '0']);

        $this->assertNull($dto->query);
        $this->assertNull($dto->priority);
        $this->assertNull($dto->userId);
        $this->assertFalse($dto->hasFilters());
    }

    #[Test]
    public function it_converts_to_array_with_enum_values(): void
    {
        $dto = TicketFilters::fromRequest(['priority' => 'alta', 'q' => 'abc']);

        $this->assertEquals([
            'q' => 'abc',
            'priority' => 'alta',
        ], $dto->toArray());
    }

    #[Test]
    public function it_rejects_date_range_starting_after_ending(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new TicketFilters(
            dateFrom: CarbonImmutable::parse('2026-08-01'),
            dateTo: CarbonImmutable::parse('2026-07-01'),
        );
    }
}
