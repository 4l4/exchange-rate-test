<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 20.02.2020
 * Time: 17:04
 */

namespace App\Handler;


use App\Service\CacheService;
use App\Service\ExchangeRateHTTPService;

/**
 * Class HTTPExchangeRateHandler
 * @package App\Handler
 *
 * The handler for getting exchange rates from the external service, if it is there,
 * if they are not in database, the handler calls the next handler
 */
class HTTPExchangeRateHandler extends AbstractExchangeRateHandler
{
    /**
     * @var ExchangeRateHTTPService
     */
    private $httpService;

    /**
     * @var CacheService
     */
    private $cacheService;

    /**
     * CacheExchangeRateHandler constructor.
     * @param ExchangeRateHTTPService $httpService
     */
    public function __construct(ExchangeRateHTTPService $httpService, CacheService $cacheService)
    {
        $this->httpService = $httpService;
        $this->cacheService = $cacheService;
    }

    public function handle(string $currency): ?array
    {
        $exchangeRates = $this->httpService->getByCurrency($currency);

        if (!empty($exchangeRates)) {
            $this->saveExchangeRate($currency, $exchangeRates);
            return $exchangeRates;
        } else {
            return parent::handle($currency);
        }
    }

    /**
     * @param $currency
     * @param $exchangeRates
     */
    private function saveExchangeRate(string  $currency, array $exchangeRates)
    {
        // Some code to save in database
        // ...

        $this->cacheService->setByKey('exchange_rate_by_' . $currency, $exchangeRates);
    }
}