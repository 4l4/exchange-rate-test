<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 20.02.2020
 * Time: 17:19
 */

namespace App\Service;

/**
 * Class CacheService
 * @package App\Service
 */
class CacheService
{
    /**
     * @param $key
     * @return array
     */
    public function getByKey(string $key): ?array
    {
        // Some code which gets exchange rate by $currency from cache
        return ['dollar' => '60', 'euro' => '70'];
    }

    /**
     * @param string $key
     * @param $value
     */
    public function setByKey(string $key, $value)
    {
        // Some code to save $value in cache with $key
    }
}