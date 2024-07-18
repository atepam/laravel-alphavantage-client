<?php

declare(strict_types=1);

use Atepam\AlphavantageClient\Services\AlphaVantage\ClientConfig;
use Atepam\AlphavantageClient\Services\AlphaVantage\LatestPriceCandleFactory;
use Atepam\AlphavantageClient\Services\AlphaVantage\LatestPriceClient;
use Atepam\AlphavantageClient\Tests\PackageTestCase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/
uses(PackageTestCase::class)->in(__DIR__);
// uses(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function deleteFileIfExists(string $file): void
{
    if (File::exists(path: $file)) {
        File::delete($file);
    }
}

function getLatestPriceClient(): LatestPriceClient
{
    $latestPriceCandleFactory = new LatestPriceCandleFactory();
    $config = new ClientConfig(
        (string)config('alphaVantage.apiKey', 'demo'),
        (string)config('alphaVantage.apiHost', 'https://www.alphavantage.co'),
    );

    return new LatestPriceClient($config, $latestPriceCandleFactory);
}

function fakeHttpForBody(array $body): void
{
    Http::fake(['https://www.alphavantage.co/*' => Http::response($body),]);
}
