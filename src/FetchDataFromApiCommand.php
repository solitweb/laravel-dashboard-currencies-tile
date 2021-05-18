<?php

namespace Solitweb\CurrenciesTile;

use Illuminate\Console\Command;

class FetchDataFromApiCommand extends Command
{
    protected $signature = 'dashboard:fetch-data-from-currency-api';

    protected $description = 'Fetch data for tile';

    public function handle(Currencies $currencies)
    {
        $this->info('Fetching currency data...');

        $data = $currencies->getCurrenciesData();

        CurrenciesStore::make()->setData($data);

        $this->info('All done!');
    }
}
