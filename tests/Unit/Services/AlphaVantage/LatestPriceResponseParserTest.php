<?php

declare(strict_types=1);

use Atepam\AlphavantageClient\Exceptions\AlphaVantage\LatestPriceDataException;
use Atepam\AlphavantageClient\Services\AlphaVantage\LatestPriceResponseParser;
use Illuminate\Support\Facades\Log;

it('parse() logs when it gets invalid price data and log is enabled', function () {
    Log::shouldReceive('critical')->once();

    $factory = new LatestPriceResponseParser(true);
    $factory->parse(getInvalidResponse());

})->throws(LatestPriceDataException::class);



it('parse() does not log when it gets invalid price data and log is disabled', function () {
    Log::shouldReceive('critical')->never();

    $factory = new LatestPriceResponseParser(false);
    $factory->parse(getInvalidResponse());

})->throws(LatestPriceDataException::class);
