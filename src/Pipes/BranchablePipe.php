<?php

namespace Slashequip\LaravelPipeline\Pipes;

use Slashequip\LaravelPipeline\Collections\PipeCollection;
use Slashequip\LaravelPipeline\Contracts\Pipe;
use Slashequip\LaravelPipeline\Contracts\Transport;

abstract class BranchablePipe implements Pipe
{
    public function handle(Transport $transport): void
    {
        $branch = $this->branch($transport);

        if (! $branch) {
            return;
        }

        $transport->getPipeline()->routeBranch($branch);
    }

    abstract public function branch(Transport $transport): ?PipeCollection;
}
