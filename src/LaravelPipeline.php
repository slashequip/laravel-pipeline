<?php

namespace Slashequip\LaravelPipeline;

use Illuminate\Contracts\Container\Container;

class LaravelPipeline
{
    public function __construct(
        public Container $app
    ) {}


}
