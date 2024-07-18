<?php

declare(strict_types=1);

namespace Atepam\AlphavantageClient\Providers;

use Atepam\AlphavantageClient\Services\AlphaVantage\ClientConfig;
use Atepam\AlphavantageClient\Services\AlphaVantage\LatestPriceClient;
use Atepam\AlphavantageClient\Services\AlphaVantage\LatestPriceResponseParser;
use Illuminate\Support\ServiceProvider;

class LatestPriceClientProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LatestPriceClient::class, function () {
            return new LatestPriceClient(
                app(ClientConfig::class),
                app(LatestPriceResponseParser::class)
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
