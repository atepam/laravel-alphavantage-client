<?php

declare(strict_types=1);

namespace Atepam\AlphavantageClient\Tests;

use Atepam\AlphavantageClient\Providers\ClientConfigProvider;
use Atepam\AlphavantageClient\Providers\LatestPriceClientProvider;
use Atepam\AlphavantageClient\Providers\LatestPriceResponseParserProvider;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase;

class PackageTestCase extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            LatestPriceClientProvider::class,
            ClientConfigProvider::class,
            LatestPriceResponseParserProvider::class,
        ];
    }

    function fakeHttpForBody(array $body): void
    {
        Http::fake(['https://www.alphavantage.co/*' => Http::response($body),]);
    }


    function getInvalidResponse(): Response
    {
        $guzzleResponse = new \GuzzleHttp\Psr7\Response(200, [], json_encode(["INVALID Global Quote" => ['irrelevant since top level key is invalid']]));

        return new Response($guzzleResponse);
    }
}
