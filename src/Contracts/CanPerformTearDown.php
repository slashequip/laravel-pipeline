<?php

namespace Slashequip\LaravelPipeline\Contracts;

use Throwable;

interface CanPerformTearDown
{
    public function teardown(Transport $transport, Throwable $e): void;
}
