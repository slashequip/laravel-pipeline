<?php

namespace Slashequip\LaravelPipeline;

use Illuminate\Contracts\Container\Container;
use Slashequip\LaravelPipeline\Collections\PipeCollection;
use Slashequip\LaravelPipeline\Contracts\CanHandleQuietly;
use Slashequip\LaravelPipeline\Contracts\CanPerformTearDown;
use Slashequip\LaravelPipeline\Contracts\Pipe;
use Slashequip\LaravelPipeline\Contracts\Transport;
use Throwable;

class Pipeline
{
    protected Transport $transport;

    protected PipeCollection $pipes;

    public function __construct(
        public Container $app
    ) {
        $this->pipes = new PipeCollection();
    }

    public function send(Transport $transport): static
    {
        $this->transport = $transport;

        return $this;
    }

    public function through(Pipe ...$pipes): static
    {
        $this->pipes = new PipeCollection(...$pipes);

        return $this;
    }

    public function deliver(): Transport
    {
        $teardownStack = collect();

        // Run pipeline logic
        while (! $this->pipes->hasRunAll()) {
            $pipe = $this->pipes->next();

            rescue(
                function () use ($pipe, $teardownStack) {
                    if ($pipe instanceof CanPerformTearDown) {
                        $teardownStack->prepend($pipe);
                    }

                    $pipe->handle($this->transport);
                },
                function (Throwable $e) use ($pipe, $teardownStack) {
                    if ($pipe instanceof CanHandleQuietly) {
                        ! $pipe->shouldReport() ?: report($e);

                        return;
                    }

                    $teardownStack
                        ->each(function (CanPerformTearDown $pipe) use ($e) {
                            rescue(function () use ($pipe, $e) {
                                $pipe->teardown($this->transport, $e);
                            });
                        });

                    throw $e;
                },
                false
            );
        }

        return $this->transport;
    }

    public function deliverAnd(callable $callback = null): mixed
    {
        return tap($this->deliver(), $callback);
    }

    public function patchBranch(Pipe ...$pipes): void
    {
        $this->pipes->patch(...$pipes);
    }
}
