<?php

namespace Slashequip\LaravelPipeline\Collections;

use Slashequip\LaravelPipeline\Contracts\Pipe;

class PipeCollection
{
    private array $pipes;

    private ?int $runningIndex = null;

    public function __construct(Pipe ...$pipes)
    {
        $this->pipes = $pipes;
    }

    public function getPipes(): array
    {
        return $this->pipes;
    }

    public function next(): ?Pipe
    {
        $nextIndex = is_null($this->runningIndex) ? 0 : ($this->runningIndex + 1);
        $nextPipe = isset($this->pipes[$nextIndex]) ? $this->pipes[$nextIndex] : null;

        if ($nextPipe) {
            $this->runningIndex = $nextIndex;
        }

        return $nextPipe;
    }

    public function patch(Pipe ...$pipes): void
    {
        $this->pipes = array_merge(
            array_slice($this->pipes, 0, ($this->runningIndex + 1)),
            $pipes,
            array_slice($this->pipes, ($this->runningIndex + 1)),
        );
    }

    public function hasRunAll(): bool
    {
        // Either we have no pipes or our running index got to the end.
        return
            count($this->pipes) === 0
            || ($this->runningIndex !== null
            && $this->runningIndex === (count($this->pipes) - 1));
    }
}
