<?php

declare(strict_types=1);

namespace Atepam\AlphavantageClient\Services;

use Atepam\AlphavantageClient\Exceptions\LatestPriceDataException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator as ValidatorFacade;

class LatestPriceResponseParser
{
    public const TOP_LEVEL_KEY = 'Global Quote';

    public function __construct(
        public readonly bool $logErrors = true,
    ) {
    }

    /**
     * @return array<string, string>
     * @throws LatestPriceDataException
     */
    public function parse(Response $response): array
    {
        $this->validateResponseData($response);

        $data = $this->getResponseDataArray($response)[self::TOP_LEVEL_KEY];

        return [
            'symbol' => $data['01. symbol'],
            'open' => $data['02. open'],
            'high' => $data['03. high'],
            'low' => $data['04. low'],
            'price' => $data['05. price'],
            'volume' => $data['06. volume'],
            'latest_trading_date' => $data['07. latest trading day'],
            'prev_close' => $data['08. previous close'],
            'change' => $data['09. change'],
            'change_percent' => $data['10. change percent'],
            'time' => Carbon::now()->toDateTimeString(),
        ];
    }

    /**
     * @throws LatestPriceDataException
     */
    protected function validateResponseData(Response $response): void
    {
        $data = $this->getResponseDataArray($response);

        $validator = ValidatorFacade::make($data, [
            self::TOP_LEVEL_KEY . ".01\. symbol" => 'required|string',
            self::TOP_LEVEL_KEY . ".02\. open" => "required|string",
            self::TOP_LEVEL_KEY . ".03\. high" => "required|string",
            self::TOP_LEVEL_KEY . ".04\. low" => "required|string",
            self::TOP_LEVEL_KEY . ".05\. price" => "required|string",
            self::TOP_LEVEL_KEY . ".06\. volume" => "required|int",
            self::TOP_LEVEL_KEY . ".07\. latest trading day" => "date",
            self::TOP_LEVEL_KEY . ".08\. previous close" => "required|string",
            self::TOP_LEVEL_KEY . ".09\. change" => "required|string",
            self::TOP_LEVEL_KEY . ".10\. change percent" => "required|string",
        ]);

        if ($validator->fails()) {

            if ($this->logErrors) {
                Log::critical('Invalid latest price candle data', [
                    'errors' => $validator->errors()->toArray(),
                ]);
            }

            throw new LatestPriceDataException();
        }
    }

    /**
     * @param Response $response
     * @return array<string, array<string, string>>
     */
    protected function getResponseDataArray(Response $response): array
    {
        return $response->json(); // @phpstan-ignore return.type
    }
}
