<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 20.02.2020
 * Time: 16:53
 */

namespace App\Command;

use App\Service\GetExchangeRateService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetExchangeRateCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:get-exchange';

    /**
     * @var GetExchangeRateService
     */
    private $exchangeRateService;

    /**
     * @param GetExchangeRateService $exchangeRateService
     */
    public function __construct(GetExchangeRateService $exchangeRateService)
    {
        parent::__construct();
        $this->exchangeRateService = $exchangeRateService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Gets the exchange rate for the provided currency')
            ->setHelp('This command allows you to get the exchange rate')
            ->addArgument('currency', InputArgument::REQUIRED, 'Currency');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $currency = $input->getArgument('currency');

        $exchangeRates = $this->exchangeRateService->getExchangeRateByCurrency($currency);

        foreach ($exchangeRates as $key => $rate) {
            $output->writeln("Exchange rate for $currency: $key -> $rate");
        }

        return 0;
    }
}