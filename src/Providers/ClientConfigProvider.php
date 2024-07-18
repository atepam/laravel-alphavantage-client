<?php

declare(strict_types=1);

namespace Atepam\AlphavantageClient\Providers;

use Atepam\AlphavantageClient\Services\AlphaVantage\ClientConfig;
use Illuminate\Support\ServiceProvider;

class ClientConfigProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ClientConfig::class, function () {
            return new ClientConfig(
                config('alphavantage.apiKey'), // @phpstan-ignore argument.type
                config('alphavantage.apiHost'), // @phpstan-ignore argument.type
            );
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
