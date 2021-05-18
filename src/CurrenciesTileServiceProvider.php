<?php

namespace Solitweb\CurrenciesTile;

use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class CurrenciesTileServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Currencies::class, function () {
            return new Currencies(config('dashboard.tiles.currencies.alpha_vantage_apikey'));
        });
    }

    public function boot()
    {
        Livewire::component('currencies-tile', CurrenciesTileComponent::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                FetchDataFromApiCommand::class,
            ]);
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/dashboard-currencies-tile'),
        ], 'dashboard-currencies-tile-views');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard-currencies-tile');
    }
}
