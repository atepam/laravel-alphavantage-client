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
    public const INVALID_RESPONSE_DATA = ["INVALID Global Quote" => ['irrelevant since top level key is invalid']];

    protected function getPackageProviders($app): array
    {
        return [
            LatestPriceClientProvider::class,
            ClientConfigProvider::class,
            LatestPriceResponseParserProvider::class,
        ];
    }

    protected function fakeHttpForInvalidResponse(): void
    {
        $this->fakeHttpForBody(self::INVALID_RESPONSE_DATA);
    }

    protected function fakeHttpForRateLimitResponse(): void
    {
        $blaBla = fake()->words(5, true);

        $this->fakeHttpForBody([
            'Information' => $blaBla . 'API rate limit' . $blaBla,
        ]);
    }

    protected function fakeHttpForValidLatestPriceResponse(): void
    {
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

        $this->fakeHttpForBody($validPriceResponseData);
    }

    protected function fakeHttpForBody(array $body): void
    {
        Http::fake(['https://www.alphavantage.co/*' => Http::response($body),]);
    }


    protected function getInvalidResponse(): Response
    {
        $guzzleResponse = new \GuzzleHttp\Psr7\Response(200, [], json_encode(self::INVALID_RESPONSE_DATA));

        return new Response($guzzleResponse);
    }
}
