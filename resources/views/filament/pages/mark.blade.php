<x-filament-panels::page>
    <form wire:submit="create">
        <div class="mb-6">
            <h3 class="my-4 text-lg capitalize">Using Mark In Forms</h3>
            {{ $this->form }}

            <x-filament::button type="submit">
                submit
            </x-filament::button>
        </div>
    </form>

    <x-filament-actions::modals />

</x-filament-panels::page>
