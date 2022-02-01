<?php

namespace Slashequip\LaravelPipeline\Transports;

use Slashequip\LaravelPipeline\Pipeline;
use Slashequip\LaravelPipeline\Contracts\Transport;
use Slashequip\LaravelPipeline\Traits\Makeable;

class SimpleTransport implements Transport
{
    use Makeable;

    protected Pipeline $pipeline;

    public function setPipeline(Pipeline $pipeline): void
    {
        $this->pipeline = $pipeline;
    }

    public function getPipeline(): Pipeline
    {
        return $this->pipeline;
    }
}
