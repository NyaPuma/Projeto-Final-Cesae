<?php

namespace Tests\Unit\Enums;

use App\Enums\UserRoleEnum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserRoleEnumTest extends TestCase
{
    #[Test]
    public function it_has_correct_values(): void
    {
        $this->assertEquals('user', UserRoleEnum::User->value);
        $this->assertEquals('technician', UserRoleEnum::Technician->value);
        $this->assertEquals('admin', UserRoleEnum::Admin->value);
    }

    #[Test]
    public function it_returns_correct_labels(): void
    {
        $this->assertEquals('Utilizador', UserRoleEnum::User->label());
        $this->assertEquals('Técnico', UserRoleEnum::Technician->label());
        $this->assertEquals('Administrador', UserRoleEnum::Admin->label());
    }

    #[Test]
    public function it_returns_all_values(): void
    {
        $values = UserRoleEnum::values();

        $this->assertIsArray($values);
        $this->assertCount(3, $values);
        $this->assertContains('user', $values);
        $this->assertContains('technician', $values);
        $this->assertContains('admin', $values);
    }

    #[Test]
    public function it_has_all_cases(): void
    {
        $cases = UserRoleEnum::cases();

        $this->assertCount(3, $cases);
        $this->assertContains(UserRoleEnum::User, $cases);
        $this->assertContains(UserRoleEnum::Technician, $cases);
        $this->assertContains(UserRoleEnum::Admin, $cases);
    }

    #[Test]
    public function it_returns_correct_colors(): void
    {
        $this->assertEquals('gray', UserRoleEnum::User->color());
        $this->assertEquals('info', UserRoleEnum::Technician->color());
        $this->assertEquals('purple', UserRoleEnum::Admin->color());
    }

    #[Test]
    public function it_returns_correct_icons(): void
    {
        $this->assertEquals('heroicon-o-user', UserRoleEnum::User->icon());
        $this->assertEquals('heroicon-o-wrench-screwdriver', UserRoleEnum::Technician->icon());
        $this->assertEquals('heroicon-o-shield-check', UserRoleEnum::Admin->icon());
    }

    #[Test]
    public function it_returns_correct_weights(): void
    {
        $this->assertEquals(1, UserRoleEnum::User->weight());
        $this->assertEquals(2, UserRoleEnum::Technician->weight());
        $this->assertEquals(3, UserRoleEnum::Admin->weight());
    }

    #[Test]
    public function it_detects_role_flags(): void
    {
        $this->assertTrue(UserRoleEnum::Admin->isAdmin());
        $this->assertFalse(UserRoleEnum::Technician->isAdmin());
        $this->assertFalse(UserRoleEnum::User->isAdmin());

        $this->assertTrue(UserRoleEnum::Technician->isTechnician());
        $this->assertFalse(UserRoleEnum::Admin->isTechnician());
        $this->assertFalse(UserRoleEnum::User->isTechnician());

        $this->assertTrue(UserRoleEnum::User->isUser());
        $this->assertFalse(UserRoleEnum::Technician->isUser());
        $this->assertFalse(UserRoleEnum::Admin->isUser());
    }

    #[Test]
    public function it_detects_elevated_privileges(): void
    {
        $this->assertTrue(UserRoleEnum::Technician->hasElevatedPrivileges());
        $this->assertTrue(UserRoleEnum::Admin->hasElevatedPrivileges());
        $this->assertFalse(UserRoleEnum::User->hasElevatedPrivileges());
    }

    #[Test]
    public function it_checks_hierarchy_roles(): void
    {
        $this->assertTrue(UserRoleEnum::Admin->hasAtLeastRole(UserRoleEnum::Technician));
        $this->assertTrue(UserRoleEnum::Admin->hasAtLeastRole(UserRoleEnum::User));
        $this->assertTrue(UserRoleEnum::Technician->hasAtLeastRole(UserRoleEnum::Technician));
        $this->assertFalse(UserRoleEnum::User->hasAtLeastRole(UserRoleEnum::Technician));
    }

    #[Test]
    public function it_normalizes_enum_instances(): void
    {
        $this->assertSame(UserRoleEnum::User, UserRoleEnum::normalize(UserRoleEnum::User));
        $this->assertSame(UserRoleEnum::Admin, UserRoleEnum::normalize(UserRoleEnum::Admin));
    }

    #[Test]
    public function it_normalizes_portuguese_synonyms(): void
    {
        $this->assertSame(UserRoleEnum::Admin, UserRoleEnum::normalize('administrador'));
        $this->assertSame(UserRoleEnum::Admin, UserRoleEnum::normalize('ADMIN'));
        $this->assertSame(UserRoleEnum::Technician, UserRoleEnum::normalize('técnico'));
        $this->assertSame(UserRoleEnum::Technician, UserRoleEnum::normalize('tecnico'));
        $this->assertSame(UserRoleEnum::User, UserRoleEnum::normalize('utilizador'));
        $this->assertSame(UserRoleEnum::User, UserRoleEnum::normalize('usuário'));
        $this->assertSame(UserRoleEnum::User, UserRoleEnum::normalize('usuario'));
        $this->assertSame(UserRoleEnum::User, UserRoleEnum::normalize('user'));
    }

    #[Test]
    public function it_normalizes_invalid_input_to_null(): void
    {
        $this->assertNull(UserRoleEnum::normalize(null));
        $this->assertNull(UserRoleEnum::normalize(123));
        $this->assertNull(UserRoleEnum::normalize([]));
        $this->assertNull(UserRoleEnum::normalize('not-a-role'));
    }
}
