<?php

namespace Tests\Unit\Enums;

use App\Enums\TicketPriorityEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketPriorityEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_values(): void
    {
        $this->assertEquals('baixa', TicketPriorityEnum::Low->value);
        $this->assertEquals('média', TicketPriorityEnum::Medium->value);
        $this->assertEquals('alta', TicketPriorityEnum::High->value);
        $this->assertEquals('crítica', TicketPriorityEnum::Critical->value);
    }

    #[Test]
    public function it_returns_correct_labels(): void
    {
        $this->assertEquals('Baixa', TicketPriorityEnum::Low->label());
        $this->assertEquals('Média', TicketPriorityEnum::Medium->label());
        $this->assertEquals('Alta', TicketPriorityEnum::High->label());
        $this->assertEquals('Crítica', TicketPriorityEnum::Critical->label());
    }

    #[Test]
    public function it_returns_all_values(): void
    {
        $values = TicketPriorityEnum::values();

        $this->assertIsArray($values);
        $this->assertCount(4, $values);
        $this->assertContains('baixa', $values);
        $this->assertContains('média', $values);
        $this->assertContains('alta', $values);
        $this->assertContains('crítica', $values);
    }

    #[Test]
    public function it_has_all_cases(): void
    {
        $cases = TicketPriorityEnum::cases();

        $this->assertCount(4, $cases);
        $this->assertContains(TicketPriorityEnum::Low, $cases);
        $this->assertContains(TicketPriorityEnum::Medium, $cases);
        $this->assertContains(TicketPriorityEnum::High, $cases);
        $this->assertContains(TicketPriorityEnum::Critical, $cases);
    }
}
