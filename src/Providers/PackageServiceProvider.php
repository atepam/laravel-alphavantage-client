<?php

declare(strict_types=1);

namespace Atepam\AlphavantageClient\Providers;

use Atepam\AlphavantageClient\Console\Commands\DataTransferObjectMakeCommand;
use Illuminate\Support\ServiceProvider;

final class PackageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands(
                commands: [
                    DataTransferObjectMakeCommand::class,
                ],
            );
        }
    }
}
