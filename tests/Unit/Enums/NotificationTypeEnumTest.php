<?php

namespace Tests\Unit\Enums;

use App\Enums\NotificationPriorityEnum;
use App\Enums\NotificationTypeEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NotificationTypeEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_values(): void
    {
        $this->assertEquals('budget_request', NotificationTypeEnum::BudgetRequest->value);
        $this->assertEquals('budget_submitted', NotificationTypeEnum::BudgetSubmitted->value);
        $this->assertEquals('budget_approved', NotificationTypeEnum::BudgetApproved->value);
        $this->assertEquals('budget_rejected', NotificationTypeEnum::BudgetRejected->value);
        $this->assertEquals('budget_auto_approved', NotificationTypeEnum::BudgetAutoApproved->value);
        $this->assertEquals('ticket_closed', NotificationTypeEnum::TicketClosed->value);
        $this->assertEquals('ticket_created', NotificationTypeEnum::TicketCreated->value);
        $this->assertEquals('priority_override', NotificationTypeEnum::PriorityOverride->value);
    }

    #[Test]
    public function it_returns_labels_in_portuguese(): void
    {
        $this->assertEquals('Pedido de Orçamento', NotificationTypeEnum::BudgetRequest->label());
        $this->assertEquals('Ticket Encerrado', NotificationTypeEnum::TicketClosed->label());
        $this->assertEquals('Alteração Manual de Prioridade', NotificationTypeEnum::PriorityOverride->label());
    }

    #[Test]
    public function it_maps_default_priorities(): void
    {
        $this->assertEquals(NotificationPriorityEnum::Urgent, NotificationTypeEnum::PriorityOverride->defaultPriority());
        $this->assertEquals(NotificationPriorityEnum::High, NotificationTypeEnum::BudgetRequest->defaultPriority());
        $this->assertEquals(NotificationPriorityEnum::Normal, NotificationTypeEnum::TicketCreated->defaultPriority());
        $this->assertEquals(NotificationPriorityEnum::Low, NotificationTypeEnum::TicketClosed->defaultPriority());
    }

    #[Test]
    public function it_detects_budget_related_types(): void
    {
        $this->assertTrue(NotificationTypeEnum::BudgetRequest->isBudgetRelated());
        $this->assertTrue(NotificationTypeEnum::BudgetSubmitted->isBudgetRelated());
        $this->assertTrue(NotificationTypeEnum::BudgetApproved->isBudgetRelated());
        $this->assertTrue(NotificationTypeEnum::BudgetRejected->isBudgetRelated());
        $this->assertTrue(NotificationTypeEnum::BudgetAutoApproved->isBudgetRelated());
        $this->assertFalse(NotificationTypeEnum::TicketClosed->isBudgetRelated());
        $this->assertFalse(NotificationTypeEnum::TicketCreated->isBudgetRelated());
        $this->assertFalse(NotificationTypeEnum::PriorityOverride->isBudgetRelated());
    }

    #[Test]
    public function it_normalizes_values(): void
    {
        $this->assertEquals(NotificationTypeEnum::BudgetApproved, NotificationTypeEnum::normalize('BUDGET_APPROVED'));
        $this->assertNull(NotificationTypeEnum::normalize('unknown'));
        $this->assertNull(NotificationTypeEnum::normalize(null));
    }

    #[Test]
    public function it_returns_all_values(): void
    {
        $this->assertCount(8, NotificationTypeEnum::values());
    }
}
