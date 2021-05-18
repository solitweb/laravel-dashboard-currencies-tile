<?php

namespace Solitweb\CurrenciesTile;

use Illuminate\Support\Facades\Http;

class Currencies
{
    public const ALPHA_VANTAGE_ENDPOINT = 'https://www.alphavantage.co/query';

    protected $apikey;

    public $fromCurrency;

    public $toCurrency;

    public function __construct(string $apikey)
    {
        $this->apikey = $apikey;

        $this->fromCurrency = config('dashboard.tiles.currencies.from_currency');

        $this->toCurrency = config('dashboard.tiles.currencies.to_currency');
    }

    public function getCurrenciesData(): array
    {
        $rates = collect();

        collect($this->fromCurrency)
            ->each(function ($fromCurrency) use ($rates) {
                $response = Http::get(self::ALPHA_VANTAGE_ENDPOINT, [
                    'function' => 'CURRENCY_EXCHANGE_RATE',
                    'from_currency' => $fromCurrency,
                    'to_currency' => $this->toCurrency,
                    'apikey' => $this->apikey
                ])->json();

                if (! array_key_exists('Realtime Currency Exchange Rate', $response)) {
                    return;
                }

                $rates->push([
                    'from_currency_code' => $response['Realtime Currency Exchange Rate']['1. From_Currency Code'],
                    'from_currency_name' => $response['Realtime Currency Exchange Rate']['2. From_Currency Name'],
                    'to_currency_code' => $response['Realtime Currency Exchange Rate']['3. To_Currency Code'],
                    'to_currency_name' => $response['Realtime Currency Exchange Rate']['4. To_Currency Name'],
                    'echange_rate' => $response['Realtime Currency Exchange Rate']['5. Exchange Rate'],
                ]);
            });

        return $rates->toArray();
    }
}