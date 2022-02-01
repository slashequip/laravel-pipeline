<?php

namespace Slashequip\LaravelPipeline\Contracts;

interface CanHandleQuietly
{
    public function shouldReport(): bool;
}
