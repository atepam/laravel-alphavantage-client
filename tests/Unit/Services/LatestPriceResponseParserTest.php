<?php

declare(strict_types=1);

use Atepam\AlphavantageClient\Exceptions\LatestPriceDataException;
use Atepam\AlphavantageClient\Services\LatestPriceResponseParser;
use Illuminate\Support\Facades\Log;

it('parse() logs when it gets invalid price data and log is enabled', function () {
    Log::shouldReceive('critical')->once();

    $parser = new LatestPriceResponseParser(true);
    $parser->parse($this->getInvalidResponse());

})->throws(LatestPriceDataException::class);



it('parse() does not log when it gets invalid price data and log is disabled', function () {
    Log::shouldReceive('critical')->never();

    $parser = new LatestPriceResponseParser(false);
    $parser->parse($this->getInvalidResponse());

})->throws(LatestPriceDataException::class);
