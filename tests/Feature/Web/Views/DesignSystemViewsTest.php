<?php

namespace Tests\Feature;

use Tests\TestCase;

class DesignSystemViewsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutVite();
    }

    public function test_public_views_render_design_system_components(): void
    {
        $home = $this->get('/');
        $home->assertOk();
        $home->assertSee('ui-button', false);

        $login = $this->get('/ui/login');
        $login->assertOk();
        $login->assertSee('ui-button', false);
    }
}
