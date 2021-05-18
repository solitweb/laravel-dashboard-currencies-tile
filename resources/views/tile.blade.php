<x-dashboard-tile :position="$position">
    <div 
        wire:poll.{{ $refreshIntervalInSeconds }}s
        class="grid {{ isset($title) ? 'grid-rows-auto-auto gap-2' : '' }} h-full"
    >
        @isset ($title)
            <h1 class="uppercase font-bold">
                {{ $title }}
            </h1>
        @endisset

        <div class="py-2">
            @forelse ($rates as $rate)
                @if ($loop->first)
                    <div class="py-2">
                        <div class="flex items-center justify-between">
                            <div class="leading-5 font-medium uppercase truncate">
                                {{ $rate['to_currency_name'] }}
                            </div>
                            <div class="text-sm uppercase text-dimmed">
                                1{{ $rate['to_currency_code'] }}
                            </div>
                        </div>
                    </div>
                @endif

                <div class="py-2">
                    <div class="flex items-center justify-between">
                        <div class="leading-5 font-medium uppercase truncate">
                            {{ $rate['from_currency_name'] }}
                        </div>
                        <div class="text-sm uppercase text-dimmed">
                            {{ number_format($rate['echange_rate'], 2, '.', ',') }}{{ $rate['from_currency_code'] }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-2">
                    No currencies available.
                </div>
            @endforelse
        </div>
    </div>
</x-dashboard-tile>
