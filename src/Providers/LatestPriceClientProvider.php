<?php

declare(strict_types=1);

namespace Atepam\AlphavantageClient\Providers;

use Atepam\AlphavantageClient\Services\AlphaVantage\ClientConfig;
use Atepam\AlphavantageClient\Services\AlphaVantage\LatestPriceCandleFactory;
use Atepam\AlphavantageClient\Services\AlphaVantage\LatestPriceClient;
use Illuminate\Support\ServiceProvider;

class LatestPriceClientProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LatestPriceClient::class, function () {
            $config = new ClientConfig(
                (string)config('alphaVantage.apiKey', 'demo'),
                (string)config('alphaVantage.apiHost', 'https://www.alphavantage.co'),
            );

            return new LatestPriceClient($config, new LatestPriceCandleFactory());
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
