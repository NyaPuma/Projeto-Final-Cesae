<?php

namespace Tests\Unit\DTOs;

use App\DTOs\BudgetSubmissionData;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BudgetSubmissionDataTest extends TestCase
{
    #[Test]
    public function it_creates_simple_estimate_from_request(): void
    {
        $dto = BudgetSubmissionData::fromSubmitEstimate(['estimated_budget' => '150.505']);

        $this->assertEquals(150.51, $dto->estimatedBudget);
        $this->assertFalse($dto->isDetailedRequest);
    }

    #[Test]
    public function it_parses_amount_with_comma_decimal_separator(): void
    {
        $dto = BudgetSubmissionData::fromSubmitEstimate(['estimated_budget' => '1250,75']);

        $this->assertEquals(1250.75, $dto->estimatedBudget);
    }

    #[Test]
    public function it_creates_detailed_request(): void
    {
        $dto = BudgetSubmissionData::fromDetailedRequest([
            'budget_amount' => 200,
            'budget_details' => ['peças' => 150, 'mão de obra' => 50],
        ]);

        $this->assertEquals(200.0, $dto->estimatedBudget);
        $this->assertTrue($dto->isDetailedRequest);
        $this->assertEquals(['peças' => 150, 'mão de obra' => 50], $dto->budgetDetails);
    }

    #[Test]
    public function it_converts_to_array(): void
    {
        $dto = BudgetSubmissionData::fromSubmitEstimate(['estimated_budget' => 100]);

        $this->assertEquals([
            'estimated_budget' => 100.0,
            'budget_details' => null,
            'is_detailed_request' => false,
        ], $dto->toArray());
    }

    #[Test]
    public function it_rejects_negative_estimates(): void
    {
        $this->expectException(InvalidArgumentException::class);

        new BudgetSubmissionData(estimatedBudget: -1);
    }

    #[Test]
    public function it_accepts_camel_case_estimated_budget_key(): void
    {
        $dto = BudgetSubmissionData::fromSubmitEstimate(['estimatedBudget' => '99.999']);

        $this->assertEquals(100.0, $dto->estimatedBudget);
    }

    #[Test]
    public function it_falls_back_to_zero_for_garbage_amount(): void
    {
        $dto = BudgetSubmissionData::fromSubmitEstimate(['estimated_budget' => 'não é um número']);

        $this->assertEquals(0.0, $dto->estimatedBudget);
    }
}
