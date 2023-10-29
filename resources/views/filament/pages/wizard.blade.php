<x-filament-panels::page>
    <div>
        <form>
            {{ $this->form }}

            <button type="submit">
                Submit
            </button>
        </form>

        <x-filament-actions::modals />
    </div>
</x-filament-panels::page>
