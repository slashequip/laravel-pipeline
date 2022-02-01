<?php

namespace Slashequip\LaravelPipeline\Contracts;

interface Pipe
{
    public function handle(Transport $transport): void;
}
