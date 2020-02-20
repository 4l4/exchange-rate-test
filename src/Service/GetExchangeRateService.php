<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 20.02.2020
 * Time: 17:43
 */

namespace App\Service;


use App\Handler\CacheExchangeRateHandler;
use App\Handler\DatabaseExchangeRateHandler;
use App\Handler\ExchangeRateHandler;
use App\Handler\HTTPExchangeRateHandler;
use App\Repository\ExchangeRateRepository;

class GetExchangeRateService
{
    /**
     * @var array
     */
    private $exchangeRate = [];

    /**
     * @var ExchangeRateHandler
     */
    private $handler;

    /**
     * @var CacheService
     */
    private $cacheService;

    /**
     * @var ExchangeRateRepository
     */
    private $exchangeRateRepository;

    /**
     * @var ExchangeRateHTTPService
     */
    private $httpService;

    /**
     * CacheExchangeRateHandler constructor.
     * @param CacheService $cacheService
     * @param ExchangeRateRepository $exchangeRateRepository
     * @param ExchangeRateHTTPService $httpService
     */
    public function __construct(
        CacheService $cacheService,
        ExchangeRateRepository $exchangeRateRepository,
        ExchangeRateHTTPService $httpService
    )
    {
        $this->cacheService = $cacheService;
        $this->exchangeRateRepository = $exchangeRateRepository;
        $this->httpService = $httpService;
    }

    public function setHandler(ExchangeRateHandler $handler): void
    {
        $this->handler = $handler;
    }

    /**
     * @param $currency
     * @param ExchangeRateHandler|null $handler
     * @return array|null
     */
    public function getExchangeRateByCurrency($currency, ExchangeRateHandler $handler = null): ?array
    {
        if (null === $handler) {
            $this->createDefaultChain();
        }
        if (null === $this->exchangeRate || empty($this->exchangeRate)) {
            $this->setExchangeRateByCurrency($this->handler->handle($currency));
        }

        return $this->exchangeRate;
    }

    /**
     * @param array $exchangeRate
     */
    public function setExchangeRateByCurrency(array $exchangeRate): void
    {
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * Creates chain of responsibility
     */
    private function createDefaultChain()
    {
        $handler = new CacheExchangeRateHandler($this->cacheService);
        $handler->setNext(new DatabaseExchangeRateHandler($this->exchangeRateRepository))
            ->setNext(new HTTPExchangeRateHandler($this->httpService, $this->cacheService));

        $this->setHandler($handler);
    }
}