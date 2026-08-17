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

    #[Test]
    public function it_sanitizes_feedback_whitespace_to_null(): void
    {
        $dto = BudgetDecisionData::fromRequest([
            'decision' => 'reject',
            'feedback' => '   ',
        ]);

        $this->assertNull($dto->feedback);
        $this->assertNull($dto->toArray()['feedback']);
    }

    #[Test]
    public function it_returns_convenience_helpers(): void
    {
        $approved = BudgetDecisionData::fromRequest(['decision' => 'approve']);
        $rejected = BudgetDecisionData::fromRequest(['decision' => 'reject']);

        $this->assertTrue($approved->isApproved());
        $this->assertFalse($approved->isRejected());

        $this->assertTrue($rejected->isRejected());
        $this->assertFalse($rejected->isApproved());
    }

    #[Test]
    public function it_throws_on_invalid_decision_value(): void
    {
        $this->expectException(\ValueError::class);

        BudgetDecisionData::fromRequest(['decision' => 'maybe']);
    }
}
