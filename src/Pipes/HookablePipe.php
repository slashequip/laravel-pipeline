<?php

namespace Slashequip\LaravelPipeline\Pipes;

use Slashequip\LaravelPipeline\Collections\PipeCollection;
use Slashequip\LaravelPipeline\Contracts\Transport;
use Slashequip\LaravelPipeline\HookRegistry;

class HookablePipe extends PatchablePipe
{
    public function __construct(protected string $hook)
    {
    }

    public static function withHook(string $hook): static
    {
        return new static($hook);
    }

    public function patch(Transport $transport): ?PipeCollection
    {
        $pipes = HookRegistry::get($this->hook);

        if ($pipes === []) {
            return null;
        }

        return new PipeCollection(...$pipes);
    }
}
