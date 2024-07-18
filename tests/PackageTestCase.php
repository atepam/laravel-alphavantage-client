<?php

declare(strict_types=1);

namespace Atepam\AlphavantageClient\Tests;

use Atepam\AlphavantageClient\Providers\ClientConfigProvider;
use Atepam\AlphavantageClient\Providers\LatestPriceClientProvider;
use Atepam\AlphavantageClient\Providers\LatestPriceResponseParserProvider;
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
}
