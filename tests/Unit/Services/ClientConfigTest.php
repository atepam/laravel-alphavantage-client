<?php

declare(strict_types=1);


use Atepam\AlphavantageClient\Exceptions\ConfigurationException;
use Atepam\AlphavantageClient\Services\ClientConfig;

it('can be instantiated successfully with syntax-valid config', function () {

    $string = fake()->word();
    $clientConfig = new ClientConfig($string, $string);

    $this->assertInstanceOf(ClientConfig::class, $clientConfig);

});


it('throws exception when api key is invalid', function () {

    $clientConfig = new ClientConfig('', fake()->word());

    $this->assertInstanceOf(ClientConfig::class, $clientConfig);

})->throws(ConfigurationException::class);


it('throws exception when api host is invalid', function () {

    $clientConfig = new ClientConfig(fake()->word(), '');

    $this->assertInstanceOf(ClientConfig::class, $clientConfig);

})->throws(ConfigurationException::class);
