<?php

namespace Slashequip\LaravelPipeline;

use Slashequip\LaravelPipeline\Commands\LaravelPipelineCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelPipelineServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-pipeline')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-pipeline_table')
            ->hasCommand(LaravelPipelineCommand::class);
    }
}
