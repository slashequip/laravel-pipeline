<?php

namespace Slashequip\LaravelPipeline\Tests\Stubs;

use Slashequip\LaravelPipeline\Collections\PipeCollection;
use Slashequip\LaravelPipeline\Contracts\Transport;
use Slashequip\LaravelPipeline\Pipes\BranchablePipe;

class TestBranchPipe extends BranchablePipe
{
    public function branch(Transport $transport): ?PipeCollection
    {
        return new PipeCollection(TestSetAgePipe::make());
    }
}
