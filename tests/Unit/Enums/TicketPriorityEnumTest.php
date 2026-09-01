<?php

namespace Tests\Unit\Enums;

use App\Enums\TicketPriorityEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TicketPriorityEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_values(): void
    {
        $this->assertEquals('baixa', TicketPriorityEnum::Low->value);
        $this->assertEquals('média', TicketPriorityEnum::Medium->value);
        $this->assertEquals('alta', TicketPriorityEnum::High->value);
        $this->assertEquals('crítica', TicketPriorityEnum::Critical->value);
    }

    #[Test]
    public function it_returns_correct_labels(): void
    {
        $this->assertEquals('Baixa', TicketPriorityEnum::Low->label());
        $this->assertEquals('Média', TicketPriorityEnum::Medium->label());
        $this->assertEquals('Alta', TicketPriorityEnum::High->label());
        $this->assertEquals('Crítica', TicketPriorityEnum::Critical->label());
    }

    #[Test]
    public function it_returns_all_values(): void
    {
        $values = TicketPriorityEnum::values();

        $this->assertIsArray($values);
        $this->assertCount(4, $values);
        $this->assertContains('baixa', $values);
        $this->assertContains('média', $values);
        $this->assertContains('alta', $values);
        $this->assertContains('crítica', $values);
    }

    #[Test]
    public function it_has_all_cases(): void
    {
        $cases = TicketPriorityEnum::cases();

        $this->assertCount(4, $cases);
        $this->assertContains(TicketPriorityEnum::Low, $cases);
        $this->assertContains(TicketPriorityEnum::Medium, $cases);
        $this->assertContains(TicketPriorityEnum::High, $cases);
        $this->assertContains(TicketPriorityEnum::Critical, $cases);
    }

    #[Test]
    public function it_normalizes_values_with_and_without_accents(): void
    {
        $this->assertSame(TicketPriorityEnum::Low, TicketPriorityEnum::normalize('Baixa'));
        $this->assertSame(TicketPriorityEnum::Medium, TicketPriorityEnum::normalize('média'));
        $this->assertSame(TicketPriorityEnum::Medium, TicketPriorityEnum::normalize('media'));
        $this->assertSame(TicketPriorityEnum::High, TicketPriorityEnum::normalize(' ALTA '));
        $this->assertSame(TicketPriorityEnum::Critical, TicketPriorityEnum::normalize('Crítica'));
        $this->assertSame(TicketPriorityEnum::Critical, TicketPriorityEnum::normalize('critica'));
        $this->assertNull(TicketPriorityEnum::normalize('urgente'));
        $this->assertNull(TicketPriorityEnum::normalize(null));
    }

    #[Test]
    public function it_returns_weights_and_sla_hours(): void
    {
        $this->assertSame(1, TicketPriorityEnum::Low->weight());
        $this->assertSame(2, TicketPriorityEnum::Medium->weight());
        $this->assertSame(3, TicketPriorityEnum::High->weight());
        $this->assertSame(4, TicketPriorityEnum::Critical->weight());

        $this->assertSame(48, TicketPriorityEnum::Low->slaHours());
        $this->assertSame(24, TicketPriorityEnum::Medium->slaHours());
        $this->assertSame(8, TicketPriorityEnum::High->slaHours());
        $this->assertSame(2, TicketPriorityEnum::Critical->slaHours());
    }

    #[Test]
    public function it_requires_immediate_attention_for_high_and_critical(): void
    {
        $this->assertFalse(TicketPriorityEnum::Low->requiresImmediateAttention());
        $this->assertFalse(TicketPriorityEnum::Medium->requiresImmediateAttention());
        $this->assertTrue(TicketPriorityEnum::High->requiresImmediateAttention());
        $this->assertTrue(TicketPriorityEnum::Critical->requiresImmediateAttention());
    }

    #[Test]
    public function it_returns_accepted_values_including_unaccented_variants(): void
    {
        $accepted = TicketPriorityEnum::acceptedValues();

        $this->assertContains('media', $accepted);
        $this->assertContains('critica', $accepted);
        $this->assertCount(6, $accepted);
    }

    #[Test]
    public function it_returns_correct_colors(): void
    {
        $this->assertEquals('gray', TicketPriorityEnum::Low->color());
        $this->assertEquals('info', TicketPriorityEnum::Medium->color());
        $this->assertEquals('warning', TicketPriorityEnum::High->color());
        $this->assertEquals('danger', TicketPriorityEnum::Critical->color());
    }

    #[Test]
    public function it_returns_correct_icons(): void
    {
        $this->assertEquals('heroicon-o-arrow-down-short', TicketPriorityEnum::Low->icon());
        $this->assertEquals('heroicon-o-minus', TicketPriorityEnum::Medium->icon());
        $this->assertEquals('heroicon-o-arrow-up-short', TicketPriorityEnum::High->icon());
        $this->assertEquals('heroicon-o-fire', TicketPriorityEnum::Critical->icon());
    }
}
