<?php

namespace Tests\Unit\DTOs;

use App\DTOs\BudgetDecisionData;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class BudgetDecisionDataTest extends TestCase
{
    #[Test]
    public function it_creates_dto_with_approve_decision(): void
    {
        $dto = new BudgetDecisionData(decision: 'approve');

        $this->assertEquals('approve', $dto->decision);
        $this->assertNull($dto->feedback);
    }

    #[Test]
    public function it_creates_dto_with_reject_decision_and_feedback(): void
    {
        $dto = new BudgetDecisionData(
            decision: 'reject',
            feedback: 'Orçamento demasiado alto'
        );

        $this->assertEquals('reject', $dto->decision);
        $this->assertEquals('Orçamento demasiado alto', $dto->feedback);
    }

    #[Test]
    public function it_creates_dto_from_request_with_decision(): void
    {
        $data = ['decision' => 'approve'];

        $dto = BudgetDecisionData::fromRequest($data);

        $this->assertEquals('approve', $dto->decision);
    }

    #[Test]
    public function it_creates_dto_from_request_with_action(): void
    {
        $data = ['action' => 'reject'];

        $dto = BudgetDecisionData::fromRequest($data);

        $this->assertEquals('reject', $dto->decision);
    }

    #[Test]
    public function it_creates_dto_from_request_with_feedback(): void
    {
        $data = [
            'decision' => 'reject',
            'feedback' => 'Test feedback',
        ];

        $dto = BudgetDecisionData::fromRequest($data);

        $this->assertEquals('reject', $dto->decision);
        $this->assertEquals('Test feedback', $dto->feedback);
    }

    #[Test]
    public function it_defaults_to_approve_when_no_decision(): void
    {
        $data = [];

        $dto = BudgetDecisionData::fromRequest($data);

        $this->assertEquals('approve', $dto->decision);
    }

    #[Test]
    public function it_is_readonly(): void
    {
        $dto = new BudgetDecisionData(decision: 'approve');

        $this->assertInstanceOf(\ReflectionClass::class, new \ReflectionClass($dto));
        $this->assertTrue((new \ReflectionClass($dto))->isReadOnly());
    }
}
