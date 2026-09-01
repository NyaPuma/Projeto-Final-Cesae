<?php

namespace Tests\Unit\Enums;

use App\Enums\StockMovementTypeEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StockMovementTypeEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_values(): void
    {
        $this->assertEquals('in', StockMovementTypeEnum::In->value);
        $this->assertEquals('out', StockMovementTypeEnum::Out->value);
        $this->assertEquals('adjust', StockMovementTypeEnum::Adjust->value);
        $this->assertEquals('return', StockMovementTypeEnum::Return->value);
    }

    #[Test]
    public function it_has_all_cases(): void
    {
        $this->assertCount(4, StockMovementTypeEnum::cases());
    }

    #[Test]
    public function it_returns_all_values(): void
    {
        $values = StockMovementTypeEnum::values();

        $this->assertCount(4, $values);
        $this->assertContains('in', $values);
        $this->assertContains('out', $values);
        $this->assertContains('adjust', $values);
        $this->assertContains('return', $values);
    }

    #[Test]
    public function it_returns_correct_labels(): void
    {
        $this->assertEquals('Entrada', StockMovementTypeEnum::In->label());
        $this->assertEquals('Saída', StockMovementTypeEnum::Out->label());
        $this->assertEquals('Ajuste', StockMovementTypeEnum::Adjust->label());
        $this->assertEquals('Devolução', StockMovementTypeEnum::Return->label());
    }

    #[Test]
    public function it_returns_correct_colors(): void
    {
        $this->assertEquals('success', StockMovementTypeEnum::In->color());
        $this->assertEquals('danger', StockMovementTypeEnum::Out->color());
        $this->assertEquals('warning', StockMovementTypeEnum::Adjust->color());
        $this->assertEquals('info', StockMovementTypeEnum::Return->color());
    }

    #[Test]
    public function it_returns_correct_icons(): void
    {
        $this->assertEquals('heroicon-o-arrow-down-tray', StockMovementTypeEnum::In->icon());
        $this->assertEquals('heroicon-o-arrow-up-tray', StockMovementTypeEnum::Out->icon());
        $this->assertEquals('heroicon-o-wrench-screwdriver', StockMovementTypeEnum::Adjust->icon());
        $this->assertEquals('heroicon-o-arrow-uturn-left', StockMovementTypeEnum::Return->icon());
    }

    #[Test]
    public function it_normalizes_values(): void
    {
        $this->assertSame(StockMovementTypeEnum::In, StockMovementTypeEnum::normalize('IN'));
        $this->assertSame(StockMovementTypeEnum::Out, StockMovementTypeEnum::normalize(' out '));
        $this->assertSame(StockMovementTypeEnum::Adjust, StockMovementTypeEnum::normalize('adjust'));
        $this->assertSame(StockMovementTypeEnum::Return, StockMovementTypeEnum::normalize('return'));
        $this->assertSame(StockMovementTypeEnum::In, StockMovementTypeEnum::normalize(StockMovementTypeEnum::In));
        $this->assertNull(StockMovementTypeEnum::normalize('invalid'));
        $this->assertNull(StockMovementTypeEnum::normalize(null));
        $this->assertNull(StockMovementTypeEnum::normalize(123));
    }
}
