<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        ax-load
        x-load-css="[@js(\Filament\Support\Facades\FilamentAsset::getStyleHref('locationpickr', 'arbermustafa/filament-locationpickr-field'))]"
        ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('locationpickr-field', 'arbermustafa/filament-locationpickr-field') }}"
        wire:ignore
        x-data="locationPickrField({
            location: $wire.$entangle('{{ $getStatePath() }}'),
            config: {{ $getMapConfig() }},
        })"
        x-ignore
    >
        <div
            x-ref="map"
            class="locationPickr w-full"
            style="height: {{ $getHeight() }}"
        ></div>
    </div>
</x-dynamic-component>
