<?php

namespace Slashequip\LaravelPipeline;

use Slashequip\LaravelPipeline\Contracts\Pipe;

class HookRegistry
{
    /**
     * @var array<string, Pipe[]>
     */
    protected static array $registry = [];

    public static function register(string $hook, Pipe ...$pipes): void
    {
        if (! isset(self::$registry[$hook])) {
            self::$registry[$hook] = [];
        }

        array_push(self::$registry[$hook], ...$pipes);
    }

    /**
     * @return Pipe[]
     */
    public static function get(string $hook): array
    {
        return self::$registry[$hook] ?? [];
    }
}
