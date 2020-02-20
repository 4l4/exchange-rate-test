<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 20.02.2020
 * Time: 17:05
 */

namespace App\Repository;

/**
 * Class ExchangeRateRepository
 * @package App\Repository
 */
class ExchangeRateRepository
{
    /**
     * @param string $currency
     * @return array
     */
    public function findExchangeRateByCurrency(string $currency): ?array
    {
        // Some code which gets exchange rate by $currency from database
        return ['dollar' => '61', 'euro' => '71'];
    }
}