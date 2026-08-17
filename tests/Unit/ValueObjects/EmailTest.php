<?php

namespace Tests\Unit\ValueObjects;

use App\ValueObjects\Email;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EmailTest extends TestCase
{
    #[Test]
    public function it_normalizes_email_to_lowercase(): void
    {
        $email = new Email('User@Example.COM');

        $this->assertEquals('user@example.com', $email->value());
    }

    #[Test]
    public function it_rejects_emails_with_surrounding_whitespace(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Email('  User@Example.COM  ');
    }

    #[Test]
    public function it_returns_local_part_and_domain(): void
    {
        $email = new Email('joao.silva@cesae.pt');

        $this->assertEquals('joao.silva', $email->localPart());
        $this->assertEquals('cesae.pt', $email->domain());
    }

    #[Test]
    public function it_compares_two_emails_for_equality(): void
    {
        $this->assertTrue((new Email('User@Example.com'))->equals(new Email('user@example.com')));
        $this->assertFalse((new Email('user@example.com'))->equals(new Email('other@example.com')));
    }

    #[Test]
    public function it_converts_to_string(): void
    {
        $this->assertEquals('user@example.com', (string) new Email('user@example.com'));
    }

    #[Test]
    public function it_rejects_invalid_email_formats(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new Email('not-an-email');
    }
}
