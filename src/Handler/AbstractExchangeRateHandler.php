<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 20.02.2020
 * Time: 17:01
 */

namespace App\Handler;

/**
 * Class AbstractExchangeRateHandler
 * @package App\Handler
 */
class AbstractExchangeRateHandler implements ExchangeRateHandler
{
    /**
     * @var ExchangeRateHandler
     */
    private $nextHandler;

    /**
     * @param ExchangeRateHandler $handler
     * @return ExchangeRateHandler
     */
    public function setNext(ExchangeRateHandler $handler): ExchangeRateHandler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    /**
     * @param string $currency
     * @return array|null
     */
    public function handle(string $currency): ?array
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($currency);
        }

        return [];
    }
}