<?php

namespace Tests\Unit\Enums;

use App\Enums\MaintenancePlanIntervalTypeEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MaintenancePlanIntervalTypeEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_values(): void
    {
        $this->assertEquals('days', MaintenancePlanIntervalTypeEnum::Days->value);
        $this->assertEquals('usage_hours', MaintenancePlanIntervalTypeEnum::UsageHours->value);
        $this->assertEquals('cycles', MaintenancePlanIntervalTypeEnum::Cycles->value);
    }

    #[Test]
    public function it_has_all_cases_and_values(): void
    {
        $this->assertCount(3, MaintenancePlanIntervalTypeEnum::cases());

        $values = MaintenancePlanIntervalTypeEnum::values();
        $this->assertCount(3, $values);
        $this->assertContains('days', $values);
        $this->assertContains('usage_hours', $values);
        $this->assertContains('cycles', $values);
    }

    #[Test]
    public function it_returns_correct_labels(): void
    {
        $this->assertEquals('Dias', MaintenancePlanIntervalTypeEnum::Days->label());
        $this->assertEquals('Horas de uso', MaintenancePlanIntervalTypeEnum::UsageHours->label());
        $this->assertEquals('Ciclos', MaintenancePlanIntervalTypeEnum::Cycles->label());
    }

    #[Test]
    public function it_normalizes_values(): void
    {
        $this->assertSame(MaintenancePlanIntervalTypeEnum::Days, MaintenancePlanIntervalTypeEnum::normalize('DAYS'));
        $this->assertSame(MaintenancePlanIntervalTypeEnum::UsageHours, MaintenancePlanIntervalTypeEnum::normalize(' usage_hours '));
        $this->assertSame(MaintenancePlanIntervalTypeEnum::Cycles, MaintenancePlanIntervalTypeEnum::normalize('cycles'));
        $this->assertSame(MaintenancePlanIntervalTypeEnum::Days, MaintenancePlanIntervalTypeEnum::normalize(MaintenancePlanIntervalTypeEnum::Days));
        $this->assertNull(MaintenancePlanIntervalTypeEnum::normalize('invalid'));
        $this->assertNull(MaintenancePlanIntervalTypeEnum::normalize(null));
        $this->assertNull(MaintenancePlanIntervalTypeEnum::normalize(42));
    }
}
