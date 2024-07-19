<?php

declare(strict_types=1);

namespace Atepam\AlphavantageClient\Services;

use Atepam\AlphavantageClient\Exceptions\ConfigurationException;

class ClientConfig
{
    public const API_HOST_NOT_PROVIDED = 'API host not provided';
    public const API_KEY_NOT_PROVIDED = 'API key not provided';

    /**
     * @throws ConfigurationException
     *
     */
    public function __construct(
        public readonly string $apiKey,
        public readonly string $apiHost,
        public readonly bool   $logErrors = false,
    ) {
        $this->validateApiKey();
        $this->validateApiHost();
    }

    /**
     * @throws ConfigurationException
     */
    protected function validateApiKey(): void
    {
        if (empty(trim($this->apiKey))) {
            throw new ConfigurationException(self::API_KEY_NOT_PROVIDED);
        }
    }

    /**
     * @throws ConfigurationException
     */
    protected function validateApiHost(): void
    {
        if (empty(trim($this->apiHost))) {
            throw new ConfigurationException(self::API_HOST_NOT_PROVIDED);
        }
    }
}
