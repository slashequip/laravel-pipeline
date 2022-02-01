<?php

namespace Slashequip\LaravelPipeline\Tests\Stubs;

use Slashequip\LaravelPipeline\Contracts\CanHandleQuietly;
use Slashequip\LaravelPipeline\Contracts\Transport;
use Slashequip\LaravelPipeline\Pipes\SimplePipe;
use Slashequip\LaravelPipeline\Tests\Exceptions\QuietTestException;

class TestThrowsQuietExceptionPipe extends SimplePipe implements CanHandleQuietly
{
    /**
     * @param TestTransport $transport
     */
    public function handle(Transport $transport): void
    {
        $transport->set("exception", QuietTestException::class);

        throw new QuietTestException();
    }

    public function shouldReport(): bool
    {
        return false;
    }
}
