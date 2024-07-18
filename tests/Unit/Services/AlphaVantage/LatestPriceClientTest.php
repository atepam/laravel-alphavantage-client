<?php

declare(strict_types=1);

use Atepam\AlphavantageClient\AVLatestPriceFacade;
use Atepam\AlphavantageClient\Exceptions\AlphaVantage\LatestPriceDataException;
use Atepam\AlphavantageClient\Services\AlphaVantage\LatestPriceClient;
use Illuminate\Support\Carbon;

it('can instantiate latest price client with valid config successfully', function () {
    $this->assertInstanceOf(
        LatestPriceClient::class,
        app(LatestPriceClient::class)
    );
});


it('getLatestPrice() returns NULL when it gets rate limited', function () {

    $rateLimitResponseBody = [
        'Information' => fake()->words(5, true) . 'API rate limit' . fake()->words(5, true),
    ];

    fakeHttpForBody($rateLimitResponseBody);

    $candle = AVLatestPriceFacade::getLatestPrice('IBM');

    $this->assertNull($candle);
});



it('getLatestPrice() returns price data array when it gets valid price data', function () {

    Carbon::setTestNow('2024-07-18 08:02:49');

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
    $validPriceResponseData = [
        "Global Quote" => [
            "01. symbol" => "IBM",
            "02. open" => "175.0000",
            "03. high" => "178.4599",
            "04. low" => "174.1500",
            "05. price" => "175.0100",
            "06. volume" => "4864735",
            "07. latest trading day" => "2024-06-24",
            "08. previous close" => "172.4600",
            "09. change" => "2.5500",
            "10. change percent" => "1.4786%"]
    ];
    fakeHttpForBody($validPriceResponseData);

    $priceData = AVLatestPriceFacade::getLatestPrice('IBM');
    $this->assertIsArray($priceData);
    $this->assertSame($expectedPriceData, $priceData);
});



it('getLatestPrice() throws LatestPriceDataException when it gets invalid price data', function () {
    fakeHttpForBody(["INVALID Global Quote" => ['irrelevant since top level key is invalid']]);

    AVLatestPriceFacade::getLatestPrice('IBM');

})->throws(LatestPriceDataException::class);
