<?php

namespace Tests\Unit\Enums;

use App\Enums\PartUnitOfMeasureEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PartUnitOfMeasureEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_values(): void
    {
        $this->assertEquals('unit', PartUnitOfMeasureEnum::Unit->value);
        $this->assertEquals('meter', PartUnitOfMeasureEnum::Meter->value);
        $this->assertEquals('liter', PartUnitOfMeasureEnum::Liter->value);
        $this->assertEquals('kg', PartUnitOfMeasureEnum::Kg->value);
        $this->assertEquals('pair', PartUnitOfMeasureEnum::Pair->value);
        $this->assertEquals('set', PartUnitOfMeasureEnum::Set->value);
        $this->assertEquals('roll', PartUnitOfMeasureEnum::Roll->value);
        $this->assertEquals('other', PartUnitOfMeasureEnum::Other->value);
    }

    #[Test]
    public function it_has_all_cases(): void
    {
        $this->assertCount(8, PartUnitOfMeasureEnum::cases());
    }

    #[Test]
    public function it_returns_all_values(): void
    {
        $values = PartUnitOfMeasureEnum::values();

        $this->assertCount(8, $values);
        $this->assertContains('unit', $values);
        $this->assertContains('other', $values);
    }

    #[Test]
    public function it_returns_correct_labels(): void
    {
        $this->assertEquals('Unidade', PartUnitOfMeasureEnum::Unit->label());
        $this->assertEquals('Metro', PartUnitOfMeasureEnum::Meter->label());
        $this->assertEquals('Litro', PartUnitOfMeasureEnum::Liter->label());
        $this->assertEquals('Quilograma (kg)', PartUnitOfMeasureEnum::Kg->label());
        $this->assertEquals('Par', PartUnitOfMeasureEnum::Pair->label());
        $this->assertEquals('Kit / Conjunto', PartUnitOfMeasureEnum::Set->label());
        $this->assertEquals('Rolo', PartUnitOfMeasureEnum::Roll->label());
        $this->assertEquals('Outro', PartUnitOfMeasureEnum::Other->label());
    }

    #[Test]
    public function it_normalizes_enum_instances_and_strings(): void
    {
        $this->assertSame(PartUnitOfMeasureEnum::Unit, PartUnitOfMeasureEnum::normalize(PartUnitOfMeasureEnum::Unit));
        $this->assertSame(PartUnitOfMeasureEnum::Kg, PartUnitOfMeasureEnum::normalize('KG'));
        $this->assertSame(PartUnitOfMeasureEnum::Pair, PartUnitOfMeasureEnum::normalize(' pair '));
        $this->assertSame(PartUnitOfMeasureEnum::Meter, PartUnitOfMeasureEnum::normalize('meter'));
        $this->assertSame(PartUnitOfMeasureEnum::Roll, PartUnitOfMeasureEnum::normalize('roll'));
        $this->assertSame(PartUnitOfMeasureEnum::Set, PartUnitOfMeasureEnum::normalize('set'));
        $this->assertSame(PartUnitOfMeasureEnum::Liter, PartUnitOfMeasureEnum::normalize('LITER'));
        $this->assertSame(PartUnitOfMeasureEnum::Other, PartUnitOfMeasureEnum::normalize('other'));
    }

    #[Test]
    public function it_normalizes_non_string_input_to_null(): void
    {
        $this->assertNull(PartUnitOfMeasureEnum::normalize(null));
        $this->assertNull(PartUnitOfMeasureEnum::normalize(123));
        $this->assertNull(PartUnitOfMeasureEnum::normalize([]));
        $this->assertNull(PartUnitOfMeasureEnum::normalize('invalid'));
    }
}
