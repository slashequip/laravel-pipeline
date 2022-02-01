<?php

namespace Slashequip\LaravelPipeline\Contracts;

use Throwable;

interface CanPerformTeardown
{
    public function teardown(Transport $transport, Throwable $e): void;
}
