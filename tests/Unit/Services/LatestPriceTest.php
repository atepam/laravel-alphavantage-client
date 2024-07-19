<?php

declare(strict_types=1);

use Atepam\AlphavantageClient\Exceptions\LatestPriceDataException;
use Atepam\AlphavantageClient\Facades\AVLatestPrice;
use Atepam\AlphavantageClient\Services\LatestPrice;
use Illuminate\Support\Carbon;

it('can instantiate latest price client', function () {
    $this->assertInstanceOf(LatestPrice::class, app(LatestPrice::class));
});


it('getLatestPrice() returns NULL when it gets rate limited response', function () {

    $this->fakeHttpForRateLimitResponse();

    $candle = AVLatestPrice::getLatestPrice('IBM');

    $this->assertNull($candle);
});


it('getLatestPrice() returns price data array when it gets valid price data', function () {

    Carbon::setTestNow('2024-07-18 08:02:49');
    $this->fakeHttpForValidLatestPriceResponse();

    $priceData = AVLatestPrice::getLatestPrice('IBM');

    $expectedPriceData = [
        "symbol" => "IBM",
        "open" => "175.0000",
        "high" => "178.4599",
        "low" => "174.1500",
        "price" => "175.0100",
        "volume" => "4864735",
        "latest_trading_date" => "2024-06-24",
        "prev_close" => "172.4600",
        "change" => "2.5500",
        "change_percent" => "1.4786%",
        "time" => "2024-07-18 08:02:49",
    ];
    $this->assertIsArray($priceData);
    $this->assertSame($expectedPriceData, $priceData);
});


it('getLatestPrice() throws exception when it gets invalid price data', function () {
    $this->fakeHttpForInvalidResponse();

    AVLatestPrice::getLatestPrice('IBM');

})->throws(LatestPriceDataException::class);
