<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\EquipmentCategory;
use App\Models\Equipment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EquipmentCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_equipment_category_has_equipments_relationship()
    {
        $category = EquipmentCategory::factory()->create(['name' => 'Informática']);
        $equipment = Equipment::factory()->create(['category_id' => $category->id]);

        $this->assertTrue($category->equipments->contains($equipment));
    }
}
