<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    // Issue with Github Actions where Vite manifest is not found causing tests to fail
    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite(); //Fixes it :D
    }
}
