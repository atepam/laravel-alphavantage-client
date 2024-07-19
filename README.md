# Alpha Vantage API Client for Laravel

## Installation

```shell
composer require atepam/laravel-alphavantage-client
```

## Configuration

```shell
php artisan vendor:publish --provider="Atepam\AlphavantageClient\Providers\LatestPriceClientProvider" --tag="config"
```

## Usage 

```php
<?php

namespace App;

use Atepam\AlphavantageClient\Services\AlphaVantage\LatestPriceClient;

class ThisIsTheClass
{
    public function handle(LatestPriceClient $avLatestPrice): void
    {
        $latestPriceData = $avLatestPrice->getLatestPrice('IBM');
    }
}
```
