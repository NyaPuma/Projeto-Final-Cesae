<?php

namespace Tests\Unit\ValueObjects;

use App\ValueObjects\Money;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class MoneyTest extends TestCase
{
    #[Test]
    public function it_stores_amount_in_cents_and_uppercases_currency(): void
    {
        $money = new Money(10050, 'eur');

        $this->assertEquals(10050, $money->amount());
        $this->assertEquals('EUR', $money->currency());
    }

    #[Test]
    public function it_creates_from_float(): void
    {
        $money = Money::fromFloat(150.75);

        $this->assertEquals(15075, $money->amount());
        $this->assertEquals(150.75, $money->toFloat());
    }

    #[Test]
    public function it_creates_zero_value(): void
    {
        $money = Money::zero();

        $this->assertTrue($money->isZero());
        $this->assertFalse($money->isPositive());
    }

    #[Test]
    public function it_formats_the_value(): void
    {
        $money = Money::fromFloat(1234.5);

        $this->assertEquals('1,234.50 EUR', $money->formatted());
        $this->assertEquals('1,234.50 EUR', (string) $money);
    }

    #[Test]
    public function it_adds_and_subtracts_money_with_same_currency(): void
    {
        $sum = Money::fromFloat(10.50)->add(Money::fromFloat(5.25));
        $this->assertEquals(1575, $sum->amount());

        $diff = Money::fromFloat(10.50)->subtract(Money::fromFloat(4.50));
        $this->assertEquals(600, $diff->amount());
    }

    #[Test]
    public function it_multiplies_money_by_a_factor(): void
    {
        $money = Money::fromFloat(10.25)->multiply(2);

        $this->assertEquals(2050, $money->amount());
    }

    #[Test]
    public function it_checks_equality(): void
    {
        $this->assertTrue(Money::fromFloat(10.00)->equals(Money::fromFloat(10.00)));
        $this->assertFalse(Money::fromFloat(10.00)->equals(Money::fromFloat(10.01)));
    }

    #[Test]
    public function it_detects_positive_amounts(): void
    {
        $this->assertTrue(Money::fromFloat(1.00)->isPositive());
        $this->assertFalse(Money::fromFloat(0.00)->isPositive());
    }

    #[Test]
    public function it_rejects_subtracting_across_different_currencies(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Money::fromFloat(10.00, 'EUR')->subtract(Money::fromFloat(5.00, 'USD'));
    }

    #[Test]
    public function it_rejects_negative_amounts(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Money(-1);
    }

    #[Test]
    public function it_rejects_invalid_currency_length(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Money(100, 'EURO');
    }

    #[Test]
    public function it_rejects_operations_across_different_currencies(): void
    {
        $this->expectException(InvalidArgumentException::class);

        Money::fromFloat(10.00, 'EUR')->add(Money::fromFloat(5.00, 'USD'));
    }
}
