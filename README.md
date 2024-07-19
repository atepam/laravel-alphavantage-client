# Alpha Vantage API Client for Laravel

## Installation

```shell
composer require atepam/laravel-alphavantage-client
```

## Configuration

```shell
php artisan vendor:publish --provider="Atepam\AlphavantageClient\Providers\LatestPriceClientProvider" --tag="config"
```

# Services

## Latest Price

https://www.alphavantage.co/documentation/#latestprice

### Usage 

Via facade
```php
    $data = AVLatestPrice::getLatestPrice('IBM');
```
Or via DI container

```php
<?php

namespace App;

use Atepam\AlphavantageClient\Services\LatestPrice;

class ThisIsTheClass
{
    public function __construct(
        public readonly LatestPrice $avLatestPrice,
    )
    {
      //
    }

    public function getLatestPrice(string $symbol): array
    {
        return $this->avLatestPrice->getLatestPrice($symbol);
    }
}
```
Or instantiate

```php
use Atepam\AlphavantageClient\Services\LatestPrice;

$client = app(LatestPrice::class);
$data = $client->getLatestPrice('IBM');

```
