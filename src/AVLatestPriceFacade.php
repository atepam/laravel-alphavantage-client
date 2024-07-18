<?php

declare(strict_types=1);

namespace Atepam\AlphavantageClient;

use Atepam\AlphavantageClient\Services\AlphaVantage\LatestPriceClient;
use Illuminate\Support\Facades\Facade;

/**
 * @method static array getLatestPrice(string $symbol)
 */
class AVLatestPriceFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LatestPriceClient::class;
    }
}
