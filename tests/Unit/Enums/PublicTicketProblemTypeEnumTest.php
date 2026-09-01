<?php

namespace Tests\Unit\Enums;

use App\Enums\PublicTicketProblemTypeEnum;
use App\Enums\TicketPriorityEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PublicTicketProblemTypeEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_values(): void
    {
        $this->assertEquals('avaria', PublicTicketProblemTypeEnum::Breakdown->value);
        $this->assertEquals('manutencao_preventiva', PublicTicketProblemTypeEnum::Preventive->value);
        $this->assertEquals('falta_consumiveis', PublicTicketProblemTypeEnum::Consumables->value);
        $this->assertEquals('outro', PublicTicketProblemTypeEnum::Other->value);
    }

    #[Test]
    public function it_has_all_cases_and_values(): void
    {
        $this->assertCount(4, PublicTicketProblemTypeEnum::cases());

        $values = PublicTicketProblemTypeEnum::values();
        $this->assertCount(4, $values);
        $this->assertContains('avaria', $values);
        $this->assertContains('outro', $values);
    }

    #[Test]
    public function it_returns_correct_labels(): void
    {
        $this->assertEquals('Avaria', PublicTicketProblemTypeEnum::Breakdown->label());
        $this->assertEquals('Manutenção Preventiva', PublicTicketProblemTypeEnum::Preventive->label());
        $this->assertEquals('Falta de Consumíveis', PublicTicketProblemTypeEnum::Consumables->label());
        $this->assertEquals('Outro', PublicTicketProblemTypeEnum::Other->label());
    }

    #[Test]
    public function it_maps_priorities(): void
    {
        $this->assertSame(TicketPriorityEnum::High, PublicTicketProblemTypeEnum::Breakdown->priority());
        $this->assertSame(TicketPriorityEnum::Low, PublicTicketProblemTypeEnum::Preventive->priority());
        $this->assertSame(TicketPriorityEnum::Medium, PublicTicketProblemTypeEnum::Consumables->priority());
        $this->assertSame(TicketPriorityEnum::Medium, PublicTicketProblemTypeEnum::Other->priority());
    }

    #[Test]
    public function it_returns_icons(): void
    {
        $this->assertEquals('heroicon-o-wrench-screwdriver', PublicTicketProblemTypeEnum::Breakdown->icon());
        $this->assertEquals('heroicon-o-shield-check', PublicTicketProblemTypeEnum::Preventive->icon());
        $this->assertEquals('heroicon-o-shopping-cart', PublicTicketProblemTypeEnum::Consumables->icon());
        $this->assertEquals('heroicon-o-document-text', PublicTicketProblemTypeEnum::Other->icon());
    }

    #[Test]
    public function it_normalizes_aliases(): void
    {
        $this->assertSame(PublicTicketProblemTypeEnum::Breakdown, PublicTicketProblemTypeEnum::normalize('breakdown'));
        $this->assertSame(PublicTicketProblemTypeEnum::Breakdown, PublicTicketProblemTypeEnum::normalize('AVARIA'));
        $this->assertSame(PublicTicketProblemTypeEnum::Preventive, PublicTicketProblemTypeEnum::normalize('manutenção preventiva'));
        $this->assertSame(PublicTicketProblemTypeEnum::Preventive, PublicTicketProblemTypeEnum::normalize('manutencao preventiva'));
        $this->assertSame(PublicTicketProblemTypeEnum::Consumables, PublicTicketProblemTypeEnum::normalize('falta de consumíveis'));
        $this->assertSame(PublicTicketProblemTypeEnum::Consumables, PublicTicketProblemTypeEnum::normalize('falta_consumiveis'));
        $this->assertSame(PublicTicketProblemTypeEnum::Other, PublicTicketProblemTypeEnum::normalize('outro'));
        $this->assertSame(PublicTicketProblemTypeEnum::Other, PublicTicketProblemTypeEnum::normalize(PublicTicketProblemTypeEnum::Other));
    }

    #[Test]
    public function it_normalizes_invalid_input_to_null(): void
    {
        $this->assertNull(PublicTicketProblemTypeEnum::normalize('unknown'));
        $this->assertNull(PublicTicketProblemTypeEnum::normalize(null));
        $this->assertNull(PublicTicketProblemTypeEnum::normalize(123));
    }
}
