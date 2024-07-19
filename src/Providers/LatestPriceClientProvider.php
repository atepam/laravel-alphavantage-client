<?php

declare(strict_types=1);

namespace Atepam\AlphavantageClient\Providers;

use Atepam\AlphavantageClient\Services\ClientConfig;
use Atepam\AlphavantageClient\Services\LatestPrice;
use Atepam\AlphavantageClient\Services\LatestPriceResponseParser;
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

        $this->app->bind(LatestPrice::class, function () {
            return new LatestPrice(
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
