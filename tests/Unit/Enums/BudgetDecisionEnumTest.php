<?php

namespace Tests\Unit\Enums;

use App\Enums\BudgetDecisionEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BudgetDecisionEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_values(): void
    {
        $this->assertEquals('approve', BudgetDecisionEnum::Approve->value);
        $this->assertEquals('reject', BudgetDecisionEnum::Reject->value);
    }

    #[Test]
    public function it_returns_labels_in_portuguese(): void
    {
        $this->assertEquals('Aprovar', BudgetDecisionEnum::Approve->label());
        $this->assertEquals('Rejeitar', BudgetDecisionEnum::Reject->label());
    }

    #[Test]
    public function all_decisions_are_final(): void
    {
        $this->assertTrue(BudgetDecisionEnum::Approve->isFinal());
        $this->assertTrue(BudgetDecisionEnum::Reject->isFinal());
    }

    #[Test]
    public function it_has_exactly_two_cases(): void
    {
        $this->assertCount(2, BudgetDecisionEnum::cases());
    }
}
