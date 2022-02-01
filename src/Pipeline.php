<?php

namespace Slashequip\LaravelPipeline;

use Closure;
use Illuminate\Contracts\Container\Container;
use Slashequip\LaravelPipeline\Contracts\Pipe;
use Slashequip\LaravelPipeline\Contracts\Transport;

class Pipeline
{
    protected PipeCollection $pipes;

    public function __construct(
        public Container $app
    ) {
    }

    public function send(Transport $transport): static
    {
        $this->transport = $transport;

        return $this;
    }

    public function through(Pipe ...$pipes): static
    {
        $this->pipes = new PipeCollection($pipes);

        return $this;
    }

    public function deliver(): Transport
    {
        // Run pipeline logic
        do {

        } while ($this->pipes->hasRunAll());

        return $this->transport;
    }

    public function deliverAnd(callable $callback = null): mixed
    {
        return tap($this->deliver(), $callback);
    }

    public function routeBranch(Pipe ...$pipes)
}
