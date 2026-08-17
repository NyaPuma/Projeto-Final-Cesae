<?php

namespace Tests\Unit\Enums;

use App\Enums\TicketWorkflowStatusEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketWorkflowStatusEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_values(): void
    {
        $this->assertEquals('open', TicketWorkflowStatusEnum::Open->value);
        $this->assertEquals('in_progress', TicketWorkflowStatusEnum::InProgress->value);
        $this->assertEquals('waiting_budget', TicketWorkflowStatusEnum::WaitingBudget->value);
        $this->assertEquals('approved', TicketWorkflowStatusEnum::Approved->value);
        $this->assertEquals('rejected', TicketWorkflowStatusEnum::Rejected->value);
        $this->assertEquals('closed', TicketWorkflowStatusEnum::Closed->value);
        $this->assertEquals('cancelled', TicketWorkflowStatusEnum::Cancelled->value);
    }

    #[Test]
    public function it_returns_labels_in_portuguese(): void
    {
        $this->assertEquals('Aberto', TicketWorkflowStatusEnum::Open->label());
        $this->assertEquals('Em Curso', TicketWorkflowStatusEnum::InProgress->label());
        $this->assertEquals('Pendente de Orçamento', TicketWorkflowStatusEnum::WaitingBudget->label());
        $this->assertEquals('Aprovado', TicketWorkflowStatusEnum::Approved->label());
        $this->assertEquals('Recusado', TicketWorkflowStatusEnum::Rejected->label());
        $this->assertEquals('Fechado', TicketWorkflowStatusEnum::Closed->label());
        $this->assertEquals('Cancelado', TicketWorkflowStatusEnum::Cancelled->label());
    }

    #[Test]
    public function it_detects_terminal_states(): void
    {
        $this->assertTrue(TicketWorkflowStatusEnum::Closed->isFinal());
        $this->assertTrue(TicketWorkflowStatusEnum::Cancelled->isFinal());
        $this->assertTrue(TicketWorkflowStatusEnum::Rejected->isFinal());
        $this->assertFalse(TicketWorkflowStatusEnum::Open->isFinal());
        $this->assertFalse(TicketWorkflowStatusEnum::InProgress->isFinal());
        $this->assertFalse(TicketWorkflowStatusEnum::WaitingBudget->isFinal());
        $this->assertFalse(TicketWorkflowStatusEnum::Approved->isFinal());
    }

    #[Test]
    public function it_detects_active_states(): void
    {
        $this->assertTrue(TicketWorkflowStatusEnum::Open->isActive());
        $this->assertFalse(TicketWorkflowStatusEnum::Closed->isActive());
    }

    #[Test]
    public function it_defines_allowed_transitions(): void
    {
        $this->assertEquals([
            TicketWorkflowStatusEnum::InProgress,
            TicketWorkflowStatusEnum::WaitingBudget,
            TicketWorkflowStatusEnum::Cancelled,
        ], TicketWorkflowStatusEnum::Open->allowedTransitions());

        $this->assertEquals([], TicketWorkflowStatusEnum::Closed->allowedTransitions());
        $this->assertEquals([], TicketWorkflowStatusEnum::Cancelled->allowedTransitions());
    }

    #[Test]
    public function it_validates_transitions(): void
    {
        $this->assertTrue(TicketWorkflowStatusEnum::Open->canTransitionTo(TicketWorkflowStatusEnum::InProgress));
        $this->assertFalse(TicketWorkflowStatusEnum::Open->canTransitionTo(TicketWorkflowStatusEnum::Closed));
        $this->assertFalse(TicketWorkflowStatusEnum::Closed->canTransitionTo(TicketWorkflowStatusEnum::Open));
    }

    #[Test]
    public function it_normalizes_values(): void
    {
        $this->assertEquals(TicketWorkflowStatusEnum::WaitingBudget, TicketWorkflowStatusEnum::normalize('WAITING_BUDGET'));
        $this->assertNull(TicketWorkflowStatusEnum::normalize('unknown'));
    }

    #[Test]
    public function it_returns_all_values(): void
    {
        $this->assertCount(7, TicketWorkflowStatusEnum::values());
    }
}
