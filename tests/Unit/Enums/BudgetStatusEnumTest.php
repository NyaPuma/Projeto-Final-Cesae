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
}
