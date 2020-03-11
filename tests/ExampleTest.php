<?php

namespace Faithgen\AppBuild\Tests;

use Orchestra\Testbench\TestCase;
use Faithgen\AppBuild\AppBuildServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [AppBuildServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
