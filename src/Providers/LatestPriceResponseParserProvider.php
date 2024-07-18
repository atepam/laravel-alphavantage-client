<?php

declare(strict_types=1);

namespace Atepam\AlphavantageClient\Providers;

use Atepam\AlphavantageClient\Services\AlphaVantage\LatestPriceResponseParser;
use Illuminate\Support\ServiceProvider;

class LatestPriceResponseParserProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LatestPriceResponseParser::class, function () {
            return new LatestPriceResponseParser(
                config('alphaVantage.logErrors', true) // @phpstan-ignore argument.type
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
