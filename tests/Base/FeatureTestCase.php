<?php

namespace Tests\Base;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Concerns\CreatesUsers;
use Tests\Concerns\SeedsLookupData;
use Tests\TestCase;

abstract class FeatureTestCase extends TestCase
{
    use CreatesUsers;
    use RefreshDatabase;
    use SeedsLookupData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seedLookupData();
    }
}
