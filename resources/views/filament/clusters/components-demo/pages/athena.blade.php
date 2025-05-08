<x-filament-panels::page>
    @livewire(\LaraZeus\Athena\Livewire\ShowService::class,[
        'service'=>\LaraZeus\Athena\Models\Service::where('slug', 'car-washer')->first()
    ], 'show-service' )
</x-filament-panels::page>
