<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 20.02.2020
 * Time: 16:59
 */

namespace App\Handler;

/**
 * Interface ExchangeRateHandler
 * @package App\Handler
 *
 * Interface for exchange rate handlers
 * Design pattern Chain Of Responsibility
 */
interface ExchangeRateHandler
{
    public function setNext(ExchangeRateHandler $handler): ExchangeRateHandler;

    public function handle(string $currency): ?array;

}