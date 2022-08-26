@if (filled($brand = config('filament.brand')))
    <div @class([
        'text-xl font-bold tracking-tight filament-brand',
        'dark:text-white' => config('filament.dark_mode'),
    ])>
        <img class="h-10" src="https://larazeus.com/images/zeus-logo.png" alt="Lara-zeus packages">
    </div>
@endif
