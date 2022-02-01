<?php

namespace Slashequip\LaravelPipeline\Contracts;

use Slashequip\LaravelPipeline\Pipeline;

interface Transport
{
    public function setPipeline(Pipeline $pipeline): void;

    public function getPipeline(): Pipeline;
}
