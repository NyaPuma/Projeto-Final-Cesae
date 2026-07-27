<?php

namespace Tests\Base;

use Tests\Concerns\CreatesUsers;
use Tests\Concerns\SeedsLookupData;
use Tests\TestCase;

abstract class FeatureTestCase extends TestCase
{
    use CreatesUsers;
    use SeedsLookupData;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seedLookupData();
    }
}
