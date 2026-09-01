<?php

declare(strict_types=1);

namespace Tests\Unit\Actions;

use App\Actions\PartCategoryActions;
use App\Models\PartCategory;
use Tests\Base\DatabaseTestCase;

final class PartCategoryActionsTest extends DatabaseTestCase
{
    private PartCategoryActions $action;

    protected function setUp(): void
    {
        parent::setUp();
        $this->action = new PartCategoryActions();
    }

    public function test_it_creates_a_part_category(): void
    {
        // Act
        $category = $this->action->create('Componentes Elétricos', true);

        // Assert
        $this->assertInstanceOf(PartCategory::class, $category);
        $this->assertSame('Componentes Elétricos', $category->name);
        $this->assertTrue($category->active);
        $this->assertDatabaseHas('part_categories', [
            'id' => $category->id,
            'name' => 'Componentes Elétricos',
            'active' => true,
        ]);
    }

    public function test_it_updates_a_part_category(): void
    {
        // Arrange
        $category = PartCategory::factory()->create(['name' => 'Antigo Nome', 'active' => true]);

        // Act
        $updated = $this->action->update($category, 'Novo Nome', false);

        // Assert
        $this->assertSame('Novo Nome', $updated->name);
        $this->assertFalse($updated->active);
        $this->assertDatabaseHas('part_categories', [
            'id' => $category->id,
            'name' => 'Novo Nome',
            'active' => false,
        ]);
    }
}
