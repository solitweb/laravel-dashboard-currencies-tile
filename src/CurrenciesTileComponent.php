<?php

namespace Solitweb\CurrenciesTile;

use Livewire\Component;

class CurrenciesTileComponent extends Component
{
    public $position;

    public $title;

    public function mount(string $position, ?string $title = null)
    {
        $this->position = $position;

        $this->title = $title;
    }

    public function render()
    {
        $currenciesStore = CurrenciesStore::make();

        return view('dashboard-currencies-tile::tile', [
            'refreshIntervalInSeconds' => config('dashboard.tiles.currencies.refresh_interval_in_seconds') ?? 60,
            'rates' => $currenciesStore->getData(),
        ]);
    }
}
