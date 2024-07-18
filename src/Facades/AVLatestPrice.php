<?php

declare(strict_types=1);

namespace Atepam\AlphavantageClient\Facades;

use Atepam\AlphavantageClient\Services\AlphaVantage\LatestPriceClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array getLatestPrice(string $symbol)
 */
class AVLatestPrice extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LatestPriceClient::class;
    }
}
