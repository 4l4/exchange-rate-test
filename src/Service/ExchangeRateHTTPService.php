<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 20.02.2020
 * Time: 17:19
 */

namespace App\Service;

/**
 * Class ExchangeRateHTTPService
 * @package App\Service
 *
 * Some class for getting exchange rates from external service
 */
class ExchangeRateHTTPService
{
    /**
     * @param $currency
     * @return array
     */
    public function getByCurrency(string $currency): ?array
    {
        //Some code
        return ['dollar' => '62', 'euro' => '72'];
    }
}