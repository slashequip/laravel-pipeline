<?php

namespace Slashequip\LaravelPipeline\Tests\Stubs;

use Slashequip\LaravelPipeline\Collections\PipeCollection;
use Slashequip\LaravelPipeline\Contracts\Transport;
use Slashequip\LaravelPipeline\Pipes\PatchablePipe;

class TestPatchPipe extends PatchablePipe
{
    public function patch(Transport $transport): ?PipeCollection
    {
        return new PipeCollection(TestSetAgePipe::make());
    }
}
