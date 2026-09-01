<?php

namespace Tests\Unit\Enums;

use App\Enums\BudgetStatusEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BudgetStatusEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_values(): void
    {
        $this->assertEquals('pending', BudgetStatusEnum::Pending->value);
        $this->assertEquals('approved', BudgetStatusEnum::Approved->value);
        $this->assertEquals('rejected', BudgetStatusEnum::Rejected->value);
    }

    #[Test]
    public function it_returns_correct_labels(): void
    {
        $this->assertEquals('Pendente', BudgetStatusEnum::Pending->label());
        $this->assertEquals('Aprovado', BudgetStatusEnum::Approved->label());
        $this->assertEquals('Rejeitado', BudgetStatusEnum::Rejected->label());
    }

    #[Test]
    public function it_has_all_cases(): void
    {
        $cases = BudgetStatusEnum::cases();

        $this->assertCount(3, $cases);
        $this->assertContains(BudgetStatusEnum::Pending, $cases);
        $this->assertContains(BudgetStatusEnum::Approved, $cases);
        $this->assertContains(BudgetStatusEnum::Rejected, $cases);
    }

    #[Test]
    public function it_returns_all_values(): void
    {
        $values = BudgetStatusEnum::values();

        $this->assertCount(3, $values);
        $this->assertContains('pending', $values);
        $this->assertContains('approved', $values);
        $this->assertContains('rejected', $values);
    }

    #[Test]
    public function it_returns_correct_colors(): void
    {
        $this->assertEquals('warning', BudgetStatusEnum::Pending->color());
        $this->assertEquals('success', BudgetStatusEnum::Approved->color());
        $this->assertEquals('danger', BudgetStatusEnum::Rejected->color());
    }

    #[Test]
    public function it_returns_correct_icons(): void
    {
        $this->assertEquals('heroicon-o-clock', BudgetStatusEnum::Pending->icon());
        $this->assertEquals('heroicon-o-check-circle', BudgetStatusEnum::Approved->icon());
        $this->assertEquals('heroicon-o-x-circle', BudgetStatusEnum::Rejected->icon());
    }

    #[Test]
    public function it_detects_terminal_states(): void
    {
        $this->assertFalse(BudgetStatusEnum::Pending->isFinal());
        $this->assertTrue(BudgetStatusEnum::Approved->isFinal());
        $this->assertTrue(BudgetStatusEnum::Rejected->isFinal());
    }

    #[Test]
    public function it_allows_transitions_only_from_pending(): void
    {
        $this->assertTrue(BudgetStatusEnum::Pending->canTransitionTo(BudgetStatusEnum::Approved));
        $this->assertTrue(BudgetStatusEnum::Pending->canTransitionTo(BudgetStatusEnum::Rejected));
        $this->assertFalse(BudgetStatusEnum::Approved->canTransitionTo(BudgetStatusEnum::Rejected));
        $this->assertFalse(BudgetStatusEnum::Rejected->canTransitionTo(BudgetStatusEnum::Approved));
    }

    #[Test]
    public function it_normalizes_values(): void
    {
        $this->assertSame(BudgetStatusEnum::Pending, BudgetStatusEnum::normalize('pending'));
        $this->assertSame(BudgetStatusEnum::Approved, BudgetStatusEnum::normalize('APPROVED'));
        $this->assertSame(BudgetStatusEnum::Rejected, BudgetStatusEnum::normalize(' rejected '));
        $this->assertSame(BudgetStatusEnum::Pending, BudgetStatusEnum::normalize(BudgetStatusEnum::Pending));
        $this->assertNull(BudgetStatusEnum::normalize('invalid'));
        $this->assertNull(BudgetStatusEnum::normalize(null));
        $this->assertNull(BudgetStatusEnum::normalize(42));
    }
}
