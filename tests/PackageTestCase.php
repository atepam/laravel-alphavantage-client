<?php

declare(strict_types=1);

namespace Atepam\AlphavantageClient\Tests;

use Atepam\AlphavantageClient\Providers\PackageServiceProvider;
use Orchestra\Testbench\TestCase;

class PackageTestCase extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            PackageServiceProvider::class,
        ];
    }
}
