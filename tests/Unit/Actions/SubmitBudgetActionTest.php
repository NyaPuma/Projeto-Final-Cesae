<?php

namespace Tests\Unit\Actions;

use App\Actions\SubmitBudgetAction;
use App\DTOs\BudgetSubmissionData;
use App\Enums\BudgetStatusEnum;
use App\Enums\TicketStatusEnum;
use App\Services\TicketStatusService;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\Base\FeatureTestCase;
use Tests\Concerns\CreatesTickets;

class SubmitBudgetActionTest extends FeatureTestCase
{
    use CreatesTickets;

    private SubmitBudgetAction $action;

    protected function setUp(): void
    {
        parent::setUp();

        app(TicketStatusService::class)->flush();

        $this->action = app(SubmitBudgetAction::class);
    }

    #[Test]
    public function it_submits_a_budget_for_an_open_ticket(): void
    {
        $ticket = $this->createTicket();

        $result = $this->action->execute(
            $ticket,
            new BudgetSubmissionData(estimatedBudget: 150.00)
        );

        $this->assertTrue($result->budget_requested);
        $this->assertEquals(BudgetStatusEnum::Pending->value, $result->budget_status);
        $this->assertEquals(150.00, $result->budget_amount);
        $this->assertNotNull($result->budget_requested_at);
    }

    #[Test]
    public function it_stores_detailed_budget_as_json(): void
    {
        $ticket = $this->createTicket();
        $details = [
            ['item' => 'Peça A', 'quantity' => 2, 'unit_price' => 50.00],
            ['item' => 'Mão de obra', 'quantity' => 1, 'unit_price' => 100.00],
        ];

        $result = $this->action->execute(
            $ticket,
            new BudgetSubmissionData(estimatedBudget: 200.00, budgetDetails: $details)
        );

        $this->assertEquals(json_encode($details), $result->budget_details);
    }

    #[Test]
    public function it_resets_previous_budget_feedback_on_resubmission(): void
    {
        $ticket = $this->createTicketWithStatus(TicketStatusEnum::Open->value, ['budget_feedback' => 'Orçamento rejeitado anteriormente']);

        $result = $this->action->execute(
            $ticket,
            new BudgetSubmissionData(estimatedBudget: 300.00)
        );

        $this->assertNull($result->budget_feedback);
    }

    #[Test]
    public function it_rejects_submitting_a_budget_for_a_closed_ticket(): void
    {
        $ticket = $this->createTicketWithStatus(TicketStatusEnum::Closed->value);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Cannot submit a budget for a ticket that is already closed.");

        $this->action->execute(
            $ticket,
            new BudgetSubmissionData(estimatedBudget: 100.00)
        );
    }

    #[Test]
    public function it_rejects_a_second_budget_while_one_is_pending(): void
    {
        $ticket = $this->createTicketWithBudget();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("A pending budget request already exists for this ticket.");

        $this->action->execute(
            $ticket,
            new BudgetSubmissionData(estimatedBudget: 500.00)
        );
    }

    #[Test]
    public function it_rejects_a_budget_estimate_of_zero(): void
    {
        $ticket = $this->createTicket();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("The budget amount must be greater than 0.");

        $this->action->execute(
            $ticket,
            new BudgetSubmissionData(estimatedBudget: 0.0)
        );
    }

    #[Test]
    public function it_loads_technician_status_and_user_on_the_updated_ticket(): void
    {
        $ticket = $this->createTicket();

        $result = $this->action->execute(
            $ticket,
            new BudgetSubmissionData(estimatedBudget: 80.00)
        );

        $this->assertTrue($result->relationLoaded('technician'));
        $this->assertTrue($result->relationLoaded('status'));
        $this->assertTrue($result->relationLoaded('user'));
    }
}
