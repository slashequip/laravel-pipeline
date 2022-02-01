<?php

namespace Slashequip\LaravelPipeline\Tests\Stubs;

use Illuminate\Support\Arr;
use Slashequip\LaravelPipeline\Transports\SimpleTransport;

class TestTransport extends SimpleTransport
{
    private array $data = [];

    public function get(string $key, mixed $default = null): mixed
    {
        return Arr::get($this->data, $key, $default);
    }

    public function set(string $key, mixed $data): mixed
    {
        return Arr::set($this->data, $key, $data);
    }
}
