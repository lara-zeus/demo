<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    @php
        $actions = $getActions();
        $getState = $getStatePath();
    @endphp

    <div x-data="{ state: $wire.$entangle('{{ $getState }}') }">
        <x-filament::input.wrapper>
            <x-filament::input
                type="text"
                x-value="state"
                wire:model="{{ $getState }}.url"
                />
        </x-filament::input.wrapper>
    </div>
</x-dynamic-component>
