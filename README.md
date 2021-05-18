# A currencies tile for the Laravel Dashboard

[![Latest Version on Packagist](https://img.shields.io/packagist/v/solitweb/laravel-dashboard-currencies-tile.svg?style=flat-square)](https://packagist.org/packages/solitweb/laravel-dashboard-currencies-tile)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/solitweb/laravel-dashboard-currencies-tile/run-tests?label=tests)](https://github.com/solitweb/laravel-dashboard-currencies-tile/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/solitweb/laravel-dashboard-currencies-tile.svg?style=flat-square)](https://packagist.org/packages/solitweb/laravel-dashboard-currencies-tile)

This tile displays currency rates from [Alpha Vantage](https://www.alphavantage.co/).

This tile can be used on [the Laravel Dashboard](https://docs.spatie.be/laravel-dashboard).

<p align="center">
  <img width="415" height="375" src="https://github.com/solitweb/laravel-dashboard-currencies-tile/raw/master/screenshot.png">
</p>

## Installation

You can install the package via composer:

```bash
composer require solitweb/laravel-dashboard-currencies-tile
```

In the dashboard config file, you must add this configuration in the tiles key.

```php
// in config/dashboard.php

return [
    // ...
    'tiles' => [
        'currencies' => [
            'alpha_vantage_apikey' => env('CURRENCIES_ALPHA_VANTAGES_APIKEY'),
            'from_currency' => 'BTC',
            'to_currency' => 'EUR',
            'refresh_interval_in_seconds' => 60,
        ],
    ],
];
```

In `app\Console\Kernel.php` you should schedule the `Solitweb\CurrenciesTile\FetchDataFromApiCommand` to run every minute.

```php
// in app/console/Kernel.php

protected function schedule(Schedule $schedule)
{
    // ...
    $schedule->command(\Solitweb\CurrenciesTile\FetchDataFromApiCommand::class)->everyMinute();
}
```

## Usage

In your dashboard view you use the `livewire:currencies-tile` component.

```html
<x-dashboard>
    <livewire:currencies-tile position="a1" title="Currencies" />
</x-dashboard>
```

### Customizing the view

If you want to customize the view used to render this tile, run this command:

```bash
php artisan vendor:publish --provider="Solitweb\CurrenciesTile\CurrenciesTileServiceProvider" --tag="dashboard-currencies-tile-views"
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email stijn@solitweb.be instead of using the issue tracker.

## Credits

- [Alpha Vantage](https://www.alphavantage.co/)
- [Spatie](https://github.com/spatie/)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
