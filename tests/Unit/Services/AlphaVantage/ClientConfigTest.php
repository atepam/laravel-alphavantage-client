<?php

declare(strict_types=1);


use Atepam\AlphavantageClient\Exceptions\AlphaVantage\ConfigurationException;
use Atepam\AlphavantageClient\Services\AlphaVantage\ClientConfig;

it('can be instantiated successfully with valid config', function () {
    $this->assertInstanceOf(
        ClientConfig::class,
        new ClientConfig(fake()->word(), fake()->word())
    );
});



it('throws configuration exception when api key is invalid', function () {
    $this->assertInstanceOf(
        ClientConfig::class,
        new ClientConfig('', fake()->word())
    );
})->throws(ConfigurationException::class);



it('throws configuration exception when api host is invalid', function () {
    $this->assertInstanceOf(
        ClientConfig::class,
        new ClientConfig(fake()->word(), '')
    );
})->throws(ConfigurationException::class);
