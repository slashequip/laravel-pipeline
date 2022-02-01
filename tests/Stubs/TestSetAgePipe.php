<?php

namespace Slashequip\LaravelPipeline\Tests\Stubs;

use Slashequip\LaravelPipeline\Contracts\Transport;
use Slashequip\LaravelPipeline\Pipes\SimplePipe;

class TestSetAgePipe extends SimplePipe
{
    /**
     * @param TestTransport $transport
     */
    public function handle(Transport $transport): void
    {
        $transport->set("age", 69);
    }
}
