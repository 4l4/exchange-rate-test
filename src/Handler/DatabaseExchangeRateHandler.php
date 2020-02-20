<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 20.02.2020
 * Time: 17:03
 */

namespace App\Handler;


use App\Repository\ExchangeRateRepository;

/**
 * Class DatabaseExchangeRateHandler
 * @package App\Handler
 *
 * The handler for getting exchange rates from the database, if it is there,
 * if they are not in database, the handler calls the next handler
 */
class DatabaseExchangeRateHandler extends AbstractExchangeRateHandler
{
    /**
     * @var ExchangeRateRepository
     */
    private $exchangeRateRepository;

    /**
     * DatabaseExchangeRateHandler constructor.
     * @param ExchangeRateRepository $exchangeRateRepository
     */
    public function __construct(ExchangeRateRepository $exchangeRateRepository)
    {
        $this->exchangeRateRepository = $exchangeRateRepository;
    }

    public function handle(string $currency): ?array
    {
        $exchangeRate = $this->exchangeRateRepository->findExchangeRateByCurrency($currency);

        if (!empty($exchangeRate)) {
            return $exchangeRate;
        } else {
            return parent::handle($currency);
        }
    }
}