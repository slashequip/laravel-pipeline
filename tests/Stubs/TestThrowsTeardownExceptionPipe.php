<?php

namespace Slashequip\LaravelPipeline\Tests\Stubs;

use Slashequip\LaravelPipeline\Contracts\CanPerformTeardown;
use Slashequip\LaravelPipeline\Contracts\Transport;
use Slashequip\LaravelPipeline\Pipes\SimplePipe;
use Slashequip\LaravelPipeline\Tests\Exceptions\TeardownTestException;
use Throwable;

class TestThrowsTeardownExceptionPipe extends SimplePipe implements CanPerformTeardown
{
    /**
     * @param TestTransport $transport
     */
    public function handle(Transport $transport): void
    {
        throw new TeardownTestException();
    }

    /**
     * @param TestTransport $transport
     */
    public function teardown(Transport $transport, Throwable $e): void
    {
        $transport->set('teardown', true);
        $transport->set('exception', get_class($e));
    }
}
