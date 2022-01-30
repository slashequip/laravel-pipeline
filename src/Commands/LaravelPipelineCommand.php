<?php

namespace Slashequip\LaravelPipeline\Commands;

use Illuminate\Console\Command;

class LaravelPipelineCommand extends Command
{
    public $signature = 'laravel-pipeline';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
