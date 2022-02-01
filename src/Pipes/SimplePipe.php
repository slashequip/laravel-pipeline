<?php

namespace Slashequip\LaravelPipeline\Pipes;

use Slashequip\LaravelPipeline\Contracts\Pipe;
use Slashequip\LaravelPipeline\Traits\Makeable;

abstract class SimplePipe implements Pipe
{
    use Makeable;
}
