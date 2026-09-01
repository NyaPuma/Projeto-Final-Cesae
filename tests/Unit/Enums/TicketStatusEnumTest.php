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

    #[Test]
    public function it_returns_accepted_values_with_unaccented_variants(): void
    {
        $accepted = TicketStatusEnum::acceptedValues();

        $this->assertCount(7, $accepted);
        $this->assertContains('pendente orcamento', $accepted);
        $this->assertContains('pendente orçamento', $accepted);
    }

    #[Test]
    public function it_returns_correct_colors(): void
    {
        $this->assertEquals('info', TicketStatusEnum::Open->color());
        $this->assertEquals('primary', TicketStatusEnum::InProgress->color());
        $this->assertEquals('success', TicketStatusEnum::Closed->color());
        $this->assertEquals('danger', TicketStatusEnum::Cancelled->color());
        $this->assertEquals('danger', TicketStatusEnum::Rejected->color());
        $this->assertEquals('warning', TicketStatusEnum::PendingBudget->color());
    }

    #[Test]
    public function it_returns_correct_icons(): void
    {
        $this->assertEquals('heroicon-o-envelope-open', TicketStatusEnum::Open->icon());
        $this->assertEquals('heroicon-o-arrow-path', TicketStatusEnum::InProgress->icon());
        $this->assertEquals('heroicon-o-check-circle', TicketStatusEnum::Closed->icon());
        $this->assertEquals('heroicon-o-x-circle', TicketStatusEnum::Cancelled->icon());
        $this->assertEquals('heroicon-o-no-symbol', TicketStatusEnum::Rejected->icon());
        $this->assertEquals('heroicon-o-banknotes', TicketStatusEnum::PendingBudget->icon());
    }

    #[Test]
    public function it_detects_terminal_states(): void
    {
        $this->assertFalse(TicketStatusEnum::Open->isFinal());
        $this->assertFalse(TicketStatusEnum::InProgress->isFinal());
        $this->assertFalse(TicketStatusEnum::PendingBudget->isFinal());
        $this->assertTrue(TicketStatusEnum::Closed->isFinal());
        $this->assertTrue(TicketStatusEnum::Cancelled->isFinal());
        $this->assertTrue(TicketStatusEnum::Rejected->isFinal());
    }

    #[Test]
    public function it_detects_active_states(): void
    {
        $this->assertTrue(TicketStatusEnum::Open->isActive());
        $this->assertTrue(TicketStatusEnum::InProgress->isActive());
        $this->assertFalse(TicketStatusEnum::Closed->isActive());
        $this->assertFalse(TicketStatusEnum::Rejected->isActive());
    }

    #[Test]
    public function it_normalizes_english_and_portuguese_variants(): void
    {
        $this->assertSame(TicketStatusEnum::Open, TicketStatusEnum::normalize('open'));
        $this->assertSame(TicketStatusEnum::Open, TicketStatusEnum::normalize('aberto'));
        $this->assertSame(TicketStatusEnum::InProgress, TicketStatusEnum::normalize('in_progress'));
        $this->assertSame(TicketStatusEnum::InProgress, TicketStatusEnum::normalize('EM CURSO'));
        $this->assertSame(TicketStatusEnum::Closed, TicketStatusEnum::normalize('fechado'));
        $this->assertSame(TicketStatusEnum::Cancelled, TicketStatusEnum::normalize('cancelado'));
        $this->assertSame(TicketStatusEnum::PendingBudget, TicketStatusEnum::normalize('pending_budget'));
        $this->assertSame(TicketStatusEnum::PendingBudget, TicketStatusEnum::normalize('pendente orcamento'));
        $this->assertSame(TicketStatusEnum::Rejected, TicketStatusEnum::normalize('recusado'));
        $this->assertSame(TicketStatusEnum::Open, TicketStatusEnum::normalize(TicketStatusEnum::Open));
    }

    #[Test]
    public function it_normalizes_invalid_input_to_null(): void
    {
        $this->assertNull(TicketStatusEnum::normalize('invalid'));
        $this->assertNull(TicketStatusEnum::normalize(null));
        $this->assertNull(TicketStatusEnum::normalize(99));
    }
}
