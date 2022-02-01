<?php

namespace Slashequip\LaravelPipeline\Traits;

trait Makeable
{
    public static function make(): static
    {
        return app(static::class);
    }
}
