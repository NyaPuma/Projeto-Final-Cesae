<?php

namespace Tests\Unit;

use App\Models\EquipmentCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_fillable_attributes(): void
    {
        $category = EquipmentCategory::create(['name' => 'Eletrónica', 'active' => true]);
        $this->assertEquals('Eletrónica', $category->name);
        $this->assertTrue($category->active);
    }

    public function test_category_default_active_is_true(): void
    {
        $category = EquipmentCategory::create(['name' => 'Mecânica', 'active' => true]);
        $this->assertTrue($category->active);
    }

    public function test_category_has_equipments_relationship(): void
    {
        $category = EquipmentCategory::create(['name' => 'Informática', 'active' => true]);
        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Relations\HasMany::class, $category->equipments());
    }
}
