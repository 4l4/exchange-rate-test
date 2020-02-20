<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 20.02.2020
 * Time: 17:03
 */

namespace App\Handler;


use App\Service\CacheService;

/**
 * Class CacheExchangeRateHandler
 * @package App\Handler
 *
 * The handler for getting exchange rates from the cache, if it is there,
 * if they are not in cache, the handler calls the next handler
 */
class CacheExchangeRateHandler extends AbstractExchangeRateHandler
{
    /**
     * @var CacheService
     */
    private $cacheService;

    /**
     * CacheExchangeRateHandler constructor.
     * @param CacheService $cacheService
     */
    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    public function handle(string $currency): ?array
    {
        $exchangeRate = $this->cacheService->getByKey('exchange_rate_by_' . $currency);

        if (!empty($exchangeRate)) {
            return $exchangeRate;
        } else {
            return parent::handle($currency);
        }
    }
}