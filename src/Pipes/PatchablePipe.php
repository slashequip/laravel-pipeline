<?php

namespace Slashequip\LaravelPipeline\Pipes;

use Slashequip\LaravelPipeline\Collections\PipeCollection;
use Slashequip\LaravelPipeline\Contracts\Transport;

abstract class PatchablePipe extends SimplePipe
{
    public function handle(Transport $transport): void
    {
        $patch = $this->patch($transport);

        if (! $patch) {
            return;
        }

        $transport->getPipeline()->patchBranch(...$patch->getPipes());
    }

    abstract public function patch(Transport $transport): ?PipeCollection;
}
