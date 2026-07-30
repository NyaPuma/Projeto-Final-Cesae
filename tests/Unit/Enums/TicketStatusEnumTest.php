<?php

namespace Tests\Unit\Enums;

use App\Enums\TicketStatusEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketStatusEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_values(): void
    {
        $this->assertEquals('aberta', TicketStatusEnum::Open->value);
        $this->assertEquals('em curso', TicketStatusEnum::InProgress->value);
        $this->assertEquals('fechada', TicketStatusEnum::Closed->value);
        $this->assertEquals('cancelada', TicketStatusEnum::Cancelled->value);
        $this->assertEquals('pendente orçamento', TicketStatusEnum::PendingBudget->value);
        $this->assertEquals('recusada', TicketStatusEnum::Rejected->value);
    }

    #[Test]
    public function it_returns_correct_labels(): void
    {
        $this->assertEquals('Aberta', TicketStatusEnum::Open->label());
        $this->assertEquals('Em Curso', TicketStatusEnum::InProgress->label());
        $this->assertEquals('Fechada', TicketStatusEnum::Closed->label());
        $this->assertEquals('Cancelada', TicketStatusEnum::Cancelled->label());
        $this->assertEquals('Pendente Orçamento', TicketStatusEnum::PendingBudget->label());
        $this->assertEquals('Recusada', TicketStatusEnum::Rejected->label());
    }

    #[Test]
    public function it_returns_enum_from_value(): void
    {
        $this->assertEquals(TicketStatusEnum::Open, TicketStatusEnum::from('aberta'));
        $this->assertEquals(TicketStatusEnum::InProgress, TicketStatusEnum::from('em curso'));
        $this->assertEquals(TicketStatusEnum::Closed, TicketStatusEnum::from('fechada'));
        $this->assertEquals(TicketStatusEnum::Cancelled, TicketStatusEnum::from('cancelada'));
        $this->assertEquals(TicketStatusEnum::PendingBudget, TicketStatusEnum::from('pendente orçamento'));
        $this->assertEquals(TicketStatusEnum::Rejected, TicketStatusEnum::from('recusada'));
    }

    #[Test]
    public function it_returns_null_for_invalid_value(): void
    {
        $this->assertNull(TicketStatusEnum::tryFrom('invalid'));
        $this->assertNull(TicketStatusEnum::tryFrom(''));
    }

    #[Test]
    public function it_returns_all_values(): void
    {
        $values = TicketStatusEnum::values();

        $this->assertIsArray($values);
        $this->assertCount(6, $values);
        $this->assertContains('aberta', $values);
        $this->assertContains('em curso', $values);
        $this->assertContains('fechada', $values);
        $this->assertContains('cancelada', $values);
        $this->assertContains('pendente orçamento', $values);
        $this->assertContains('recusada', $values);
    }

    #[Test]
    public function it_has_all_cases(): void
    {
        $cases = TicketStatusEnum::cases();

        $this->assertCount(6, $cases);
        $this->assertContains(TicketStatusEnum::Open, $cases);
        $this->assertContains(TicketStatusEnum::InProgress, $cases);
        $this->assertContains(TicketStatusEnum::Closed, $cases);
        $this->assertContains(TicketStatusEnum::Cancelled, $cases);
        $this->assertContains(TicketStatusEnum::PendingBudget, $cases);
        $this->assertContains(TicketStatusEnum::Rejected, $cases);
    }
}
