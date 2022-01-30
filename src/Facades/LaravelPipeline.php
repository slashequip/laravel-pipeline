<?php

namespace Slashequip\LaravelPipeline\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Slashequip\LaravelPipeline\LaravelPipeline
 */
class LaravelPipeline extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-pipeline';
    }
}
