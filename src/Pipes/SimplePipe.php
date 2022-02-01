<?php

namespace Slashequip\LaravelPipeline\Pipes;

use Slashequip\LaravelPipeline\Contracts\Pipe;

abstract class BranchablePipe implements Pipe
{
    public static function make(): static
    {
        return app(static::class);
    }
}
