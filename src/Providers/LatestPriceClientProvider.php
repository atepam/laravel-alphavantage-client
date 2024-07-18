<?php

declare(strict_types=1);

namespace Atepam\AlphavantageClient\Providers;

use Atepam\AlphavantageClient\Services\AlphaVantage\ClientConfig;
use Atepam\AlphavantageClient\Services\AlphaVantage\LatestPriceClient;
use Atepam\AlphavantageClient\Services\AlphaVantage\LatestPriceResponseParser;
use Illuminate\Support\ServiceProvider;

class LatestPriceClientProvider extends ServiceProvider
{
    private const CONFIG_FILE_NAME = 'alphavantage.php';
    private const CONFIG_FILE_FULL_PATH = __DIR__ . '/../config/' . self::CONFIG_FILE_NAME;

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(self::CONFIG_FILE_FULL_PATH, 'alphavantage');

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
        $this->publishes([
            self::CONFIG_FILE_FULL_PATH => config_path(self::CONFIG_FILE_NAME),
        ]);
    }
}
