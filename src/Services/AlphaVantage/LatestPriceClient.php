<?php

declare(strict_types=1);

namespace Atepam\AlphavantageClient\Services\AlphaVantage;

use Atepam\AlphavantageClient\Exceptions\AlphaVantage\LatestPriceDataException;
use Atepam\AlphavantageClient\Exceptions\AlphaVantage\RateLimitException;
use Illuminate\Http\Client\ConnectionException;

class LatestPriceClient extends AbstractAlphaVantageClient
{
    public const FUNCTION = 'GLOBAL_QUOTE';
    public const BASE_URI = '/query';

    public function __construct(
        ClientConfig                               $config,
        private readonly LatestPriceResponseParser $responseParser,
    ) {
        parent::__construct($config);
    }

    /**
     * @return null|array<string, string>
     * @throws LatestPriceDataException|RateLimitException|ConnectionException
     */
    public function getLatestPrice(string $symbol): ?array
    {
        $response = $this->get(['symbol' => $symbol]);

        return $response
            ? $this->responseParser->parse($response)
            : null;
    }
}
