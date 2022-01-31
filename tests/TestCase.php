<?php

namespace Slashequip\LaravelPipeline\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Slashequip\LaravelPipeline\LaravelPipelineServiceProvider;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelPipelineServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        //
    }
}
