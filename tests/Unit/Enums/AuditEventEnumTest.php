<?php

namespace Tests\Unit\Enums;

use App\Enums\AuditEventEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuditEventEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_values(): void
    {
        $this->assertEquals('created', AuditEventEnum::Created->value);
        $this->assertEquals('updated', AuditEventEnum::Updated->value);
        $this->assertEquals('deleted', AuditEventEnum::Deleted->value);
        $this->assertEquals('login', AuditEventEnum::Login->value);
        $this->assertEquals('logout', AuditEventEnum::Logout->value);
        $this->assertEquals('password_changed', AuditEventEnum::PasswordChanged->value);
    }

    #[Test]
    public function it_returns_labels_in_portuguese(): void
    {
        $this->assertEquals('Registo Criado', AuditEventEnum::Created->label());
        $this->assertEquals('Registo Atualizado', AuditEventEnum::Updated->label());
        $this->assertEquals('Registo Eliminado', AuditEventEnum::Deleted->label());
        $this->assertEquals('Início de Sessão', AuditEventEnum::Login->label());
        $this->assertEquals('Fim de Sessão', AuditEventEnum::Logout->label());
        $this->assertEquals('Palavra-passe Alterada', AuditEventEnum::PasswordChanged->label());
    }

    #[Test]
    public function it_returns_color_for_each_event(): void
    {
        $this->assertEquals('success', AuditEventEnum::Created->color());
        $this->assertEquals('info', AuditEventEnum::Updated->color());
        $this->assertEquals('danger', AuditEventEnum::Deleted->color());
        $this->assertEquals('gray', AuditEventEnum::Login->color());
        $this->assertEquals('gray', AuditEventEnum::Logout->color());
        $this->assertEquals('warning', AuditEventEnum::PasswordChanged->color());
    }

    #[Test]
    public function it_identifies_auth_events(): void
    {
        $this->assertTrue(AuditEventEnum::Login->isAuthEvent());
        $this->assertTrue(AuditEventEnum::Logout->isAuthEvent());
        $this->assertTrue(AuditEventEnum::PasswordChanged->isAuthEvent());
        $this->assertFalse(AuditEventEnum::Created->isAuthEvent());
        $this->assertFalse(AuditEventEnum::Updated->isAuthEvent());
        $this->assertFalse(AuditEventEnum::Deleted->isAuthEvent());
    }

    #[Test]
    public function it_normalizes_values_case_insensitively(): void
    {
        $this->assertEquals(AuditEventEnum::Created, AuditEventEnum::normalize('CREATED'));
        $this->assertEquals(AuditEventEnum::Login, AuditEventEnum::normalize('Login'));
        $this->assertNull(AuditEventEnum::normalize('unknown'));
        $this->assertNull(AuditEventEnum::normalize(42));
    }

    #[Test]
    public function it_returns_all_values(): void
    {
        $this->assertCount(6, AuditEventEnum::values());
        $this->assertContains('created', AuditEventEnum::values());
        $this->assertContains('password_changed', AuditEventEnum::values());
    }
}
