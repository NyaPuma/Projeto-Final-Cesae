<?php

namespace Tests\Unit\Enums;

use App\Enums\NotificationPriorityEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class NotificationPriorityEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_values(): void
    {
        $this->assertEquals('low', NotificationPriorityEnum::Low->value);
        $this->assertEquals('normal', NotificationPriorityEnum::Normal->value);
        $this->assertEquals('high', NotificationPriorityEnum::High->value);
        $this->assertEquals('urgent', NotificationPriorityEnum::Urgent->value);
    }

    #[Test]
    public function it_returns_labels_in_portuguese(): void
    {
        $this->assertEquals('Baixa', NotificationPriorityEnum::Low->label());
        $this->assertEquals('Normal', NotificationPriorityEnum::Normal->label());
        $this->assertEquals('Alta', NotificationPriorityEnum::High->label());
        $this->assertEquals('Urgente', NotificationPriorityEnum::Urgent->label());
    }

    #[Test]
    public function it_returns_colors(): void
    {
        $this->assertEquals('gray', NotificationPriorityEnum::Low->color());
        $this->assertEquals('info', NotificationPriorityEnum::Normal->color());
        $this->assertEquals('warning', NotificationPriorityEnum::High->color());
        $this->assertEquals('danger', NotificationPriorityEnum::Urgent->color());
    }

    #[Test]
    public function it_returns_weights(): void
    {
        $this->assertEquals(1, NotificationPriorityEnum::Low->weight());
        $this->assertEquals(2, NotificationPriorityEnum::Normal->weight());
        $this->assertEquals(3, NotificationPriorityEnum::High->weight());
        $this->assertEquals(4, NotificationPriorityEnum::Urgent->weight());
    }

    #[Test]
    public function it_detects_high_priority(): void
    {
        $this->assertTrue(NotificationPriorityEnum::High->isHighPriority());
        $this->assertTrue(NotificationPriorityEnum::Urgent->isHighPriority());
        $this->assertFalse(NotificationPriorityEnum::Low->isHighPriority());
        $this->assertFalse(NotificationPriorityEnum::Normal->isHighPriority());
    }

    #[Test]
    public function it_normalizes_values(): void
    {
        $this->assertEquals(NotificationPriorityEnum::Urgent, NotificationPriorityEnum::normalize('URGENT'));
        $this->assertNull(NotificationPriorityEnum::normalize(123));
        $this->assertNull(NotificationPriorityEnum::normalize('nope'));
    }

    #[Test]
    public function it_returns_all_values(): void
    {
        $this->assertCount(4, NotificationPriorityEnum::values());
    }

    #[Test]
    public function it_returns_icons(): void
    {
        $this->assertEquals('heroicon-o-arrow-down', NotificationPriorityEnum::Low->icon());
        $this->assertEquals('heroicon-o-minus', NotificationPriorityEnum::Normal->icon());
        $this->assertEquals('heroicon-o-arrow-up', NotificationPriorityEnum::High->icon());
        $this->assertEquals('heroicon-o-exclamation-triangle', NotificationPriorityEnum::Urgent->icon());
    }
}
