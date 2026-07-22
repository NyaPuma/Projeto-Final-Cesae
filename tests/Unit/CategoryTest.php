<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Equipment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_fillable_attributes()
    {
        $category = Category::create(['name' => 'Eletrónica']);
        $this->assertEquals('Eletrónica', $category->name);
    }
}
