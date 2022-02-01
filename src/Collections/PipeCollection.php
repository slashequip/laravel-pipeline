<?php

namespace Slashequip\LaravelPipeline\Collections;

use Slashequip\LaravelPipeline\Contracts\Pipe;

class PipeCollection
{
    public function __construct(
        private Pipe ...$pipes
    ) {
    }

    public function getPipes()
    {
        return $this->pipes;
    }

    public function hasRunAll(): bool
    {
        //
    }
}
