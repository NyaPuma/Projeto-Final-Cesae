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
}
