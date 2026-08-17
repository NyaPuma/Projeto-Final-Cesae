<?php

namespace Tests\Unit\DTOs;

use App\DTOs\ScheduleTicketData;
use Carbon\CarbonImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ScheduleTicketDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_from_constructor(): void
    {
        $start = CarbonImmutable::parse('2026-08-01 09:00:00');
        $end = CarbonImmutable::parse('2026-08-01 11:00:00');

        $dto = new ScheduleTicketData(scheduledAt: $start, scheduledEnd: $end);

        $this->assertTrue($start->equalTo($dto->scheduledAt));
        $this->assertTrue($end->equalTo($dto->scheduledEnd));
    }

    #[Test]
    public function it_creates_dto_from_request(): void
    {
        $dto = ScheduleTicketData::fromRequest([
            'scheduled_at' => '2026-08-02 10:30:00',
            'scheduled_end' => '2026-08-02 12:00:00',
        ]);

        $this->assertInstanceOf(CarbonImmutable::class, $dto->scheduledAt);
        $this->assertEquals('2026-08-02 10:30:00', $dto->scheduledAt->toDateTimeString());
        $this->assertEquals('2026-08-02 12:00:00', $dto->scheduledEnd->toDateTimeString());
    }

    #[Test]
    public function it_creates_dto_without_end_date(): void
    {
        $dto = ScheduleTicketData::fromRequest(['scheduled_at' => '2026-08-02 10:30:00']);

        $this->assertNull($dto->scheduledEnd);
    }

    #[Test]
    public function it_converts_to_array(): void
    {
        $dto = ScheduleTicketData::fromRequest(['scheduled_at' => '2026-08-02 10:30:00']);

        $this->assertEquals([
            'scheduled_at' => '2026-08-02 10:30:00',
            'scheduled_end' => null,
        ], $dto->toArray());
    }

    #[Test]
    public function it_throws_when_missing_scheduled_at(): void
    {
        $this->expectException(InvalidArgumentException::class);

        ScheduleTicketData::fromRequest([]);
    }

    #[Test]
    public function it_rejects_end_before_start(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new ScheduleTicketData(
            scheduledAt: CarbonImmutable::parse('2026-08-02 12:00:00'),
            scheduledEnd: CarbonImmutable::parse('2026-08-02 10:00:00'),
        );
    }
}
