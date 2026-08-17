<?php

namespace Tests\Unit\ValueObjects;

use App\Domain\Ticket\ValueObjects\BudgetPauseMinutes;
use Carbon\CarbonImmutable;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BudgetPauseMinutesTest extends TestCase
{
    #[Test]
    public function it_calculates_minutes_between_request_and_decision(): void
    {
        $pause = BudgetPauseMinutes::make(
            CarbonImmutable::parse('2026-07-01 10:00:00'),
            CarbonImmutable::parse('2026-07-01 11:30:00'),
        );

        $this->assertEquals(90, $pause->value());
        $this->assertEquals(1.5, $pause->toHours());
    }

    #[Test]
    public function it_returns_zero_when_dates_are_missing(): void
    {
        $noDecision = BudgetPauseMinutes::make(CarbonImmutable::now(), null);
        $noRequest = BudgetPauseMinutes::make(null, CarbonImmutable::now());
        $bothMissing = BudgetPauseMinutes::make(null, null);

        $this->assertEquals(0, $noDecision->value());
        $this->assertEquals(0, $noRequest->value());
        $this->assertEquals(0, $bothMissing->value());
    }

    #[Test]
    public function it_returns_zero_when_decision_precedes_request(): void
    {
        $pause = BudgetPauseMinutes::make(
            CarbonImmutable::parse('2026-07-01 11:00:00'),
            CarbonImmutable::parse('2026-07-01 10:00:00'),
        );

        $this->assertEquals(0, $pause->value());
    }

    #[Test]
    public function it_detects_pending_pause(): void
    {
        $this->assertTrue(BudgetPauseMinutes::make(CarbonImmutable::now(), null)->isPending());
        $this->assertFalse(BudgetPauseMinutes::make(CarbonImmutable::now(), CarbonImmutable::now())->isPending());
    }

    #[Test]
    public function it_detects_empty_pause(): void
    {
        $this->assertTrue(BudgetPauseMinutes::make(null, null)->isEmpty());
        $this->assertFalse(BudgetPauseMinutes::make(
            CarbonImmutable::parse('2026-07-01 10:00:00'),
            CarbonImmutable::parse('2026-07-01 10:30:00'),
        )->isEmpty());
    }

    #[Test]
    public function it_serializes_to_string_and_json(): void
    {
        $pause = BudgetPauseMinutes::make(
            CarbonImmutable::parse('2026-07-01 10:00:00'),
            CarbonImmutable::parse('2026-07-01 10:45:00'),
        );

        $this->assertEquals('45', (string) $pause);
        $this->assertEquals(45, $pause->jsonSerialize());
        $this->assertEquals(45, json_decode(json_encode($pause), true));
    }
}
