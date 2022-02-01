<?php

namespace Slashequip\LaravelPipeline\Tests\Stubs;

use Slashequip\LaravelPipeline\Contracts\Transport;
use Slashequip\LaravelPipeline\Pipes\SimplePipe;
use Slashequip\LaravelPipeline\Tests\Exceptions\RegularTestException;

class TestThrowsExceptionPipe extends SimplePipe
{
    /**
     * @param TestTransport $transport
     */
    public function handle(Transport $transport): void
    {
        throw new RegularTestException();
    }
}
