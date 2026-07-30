<?php

namespace Tests\Unit\DTOs;

use App\DTOs\BudgetDecisionData;
use App\Enums\BudgetDecisionEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BudgetDecisionDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_with_approve_decision(): void
    {
        $dto = new BudgetDecisionData(decision: BudgetDecisionEnum::Approve);

        $this->assertEquals(BudgetDecisionEnum::Approve, $dto->decision);
        $this->assertNull($dto->feedback);
    }

    #[Test]
    public function it_creates_dto_with_reject_decision_and_feedback(): void
    {
        $dto = new BudgetDecisionData(
            decision: BudgetDecisionEnum::Reject,
            feedback: 'Orçamento demasiado alto'
        );

        $this->assertEquals(BudgetDecisionEnum::Reject, $dto->decision);
        $this->assertEquals('Orçamento demasiado alto', $dto->feedback);
    }

    #[Test]
    public function it_creates_dto_from_request_with_decision(): void
    {
        $data = ['decision' => 'approve'];

        $dto = BudgetDecisionData::fromRequest($data);

        $this->assertEquals(BudgetDecisionEnum::Approve, $dto->decision);
    }

    #[Test]
    public function it_creates_dto_from_request_with_action(): void
    {
        $data = ['action' => 'reject'];

        $dto = BudgetDecisionData::fromRequest($data);

        $this->assertEquals(BudgetDecisionEnum::Reject, $dto->decision);
    }

    #[Test]
    public function it_creates_dto_from_request_with_feedback(): void
    {
        $data = [
            'decision' => 'reject',
            'feedback' => 'Test feedback',
        ];

        $dto = BudgetDecisionData::fromRequest($data);

        $this->assertEquals(BudgetDecisionEnum::Reject, $dto->decision);
        $this->assertEquals('Test feedback', $dto->feedback);
    }

    #[Test]
    public function it_defaults_to_approve_when_no_decision(): void
    {
        $data = [];

        $dto = BudgetDecisionData::fromRequest($data);

        $this->assertEquals(BudgetDecisionEnum::Approve, $dto->decision);
    }

    #[Test]
    public function it_is_readonly(): void
    {
        $dto = new BudgetDecisionData(decision: BudgetDecisionEnum::Approve);

        $this->assertInstanceOf(\ReflectionClass::class, new \ReflectionClass($dto));
        $this->assertTrue((new \ReflectionClass($dto))->isReadOnly());
    }
}
