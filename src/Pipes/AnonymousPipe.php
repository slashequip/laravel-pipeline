<?php

namespace Slashequip\LaravelPipeline\Pipes;

use Closure;
use Slashequip\LaravelPipeline\Contracts\Pipe;
use Slashequip\LaravelPipeline\Contracts\Transport;

class AnonymousPipe implements Pipe
{
    private ?Closure $callback = null;

    public static function make(Closure $callback): static
    {
        return app(static::class)
            ->setCallback($callback);
    }

    public function setCallback(Closure $callback): static
    {
        $this->callback = $callback;

        return $this;
    }

    public function handle(Transport $transport): void
    {
        if ($this->callback) {
            ($this->callback)($transport);
        }
    }
}
