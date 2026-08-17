<?php

namespace Tests\Unit\ValueObjects;

use App\ValueObjects\SerialNumber;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SerialNumberTest extends TestCase
{
    #[Test]
    public function it_normalizes_serial_to_uppercase(): void
    {
        $serial = new SerialNumber('sn-1234-xyz');

        $this->assertEquals('SN-1234-XYZ', $serial->value());
    }

    #[Test]
    public function it_rejects_serials_with_surrounding_whitespace(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new SerialNumber('  SN-1234  ');
    }

    #[Test]
    public function it_compares_two_serial_numbers(): void
    {
        $this->assertTrue((new SerialNumber('abc-123'))->equals(new SerialNumber('ABC-123')));
        $this->assertFalse((new SerialNumber('abc-123'))->equals(new SerialNumber('abc-124')));
    }

    #[Test]
    public function it_converts_to_string(): void
    {
        $this->assertEquals('SN-1234', (string) new SerialNumber('sn-1234'));
    }

    #[Test]
    public function it_rejects_empty_serial(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new SerialNumber('');
    }

    #[Test]
    public function it_rejects_serial_shorter_than_three_characters(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new SerialNumber('ab');
    }

    #[Test]
    public function it_rejects_serial_with_invalid_characters(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new SerialNumber('ABC_123');
    }
}
