<?php

namespace Solitweb\CurrenciesTile;

use Spatie\Dashboard\Models\Tile;

class CurrenciesStore
{
    private Tile $tile;

    public static function make()
    {
        return new static();
    }

    public function __construct()
    {
        $this->tile = Tile::firstOrCreateForName('currencies');
    }

    public function setData(array $data): self
    {
        $this->tile->putData('currencies', $data);

        return $this;
    }

    public function getData(): array
    {
        return $this->tile->getData('currencies') ?? [];
    }
}
