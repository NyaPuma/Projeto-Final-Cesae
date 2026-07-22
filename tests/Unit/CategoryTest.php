<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_fillable_attributes()
    {
        $category = Category::create(['name' => 'Eletrónica']);
        $this->assertEquals('Eletrónica', $category->name);
    }
}
