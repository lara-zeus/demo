<x-filament-panels::page>
    <div class="mb-6">
        <h3 class="my-4 text-lg capitalize">Using Accordion In Forms</h3>

        <div>
            <form wire:submit="create">
                {{ $this->form }}

                <button type="submit">
                    Submit
                </button>
            </form>

            <x-filament-actions::modals />
        </div>

    </div>

    <div class="my-6">
        <h3 class="my-4 text-lg capitalize">Using Accordion In Infolist</h3>
        {{ $this->infolist }}
    </div>

    <div class="my-6">
        <h3 class="my-4 text-lg capitalize">Using Accordion As A Blade Component</h3>
        <x-zeus-accordion::accordion activeAccordion="1">
            <x-zeus-accordion::accordion.item
                :label="__('Contact Us')"
                icon="tabler-brand-pagekit"
            >
                <p>title</p>
                <p>title</p>
            </x-zeus-accordion::accordion.item>

            <x-zeus-accordion::accordion.item
                :label="__('Call Us')"
                icon="tabler-mail"
                badge="New Item"
                badgeColor="danger"
            >
                <p>info</p>
                <p>info</p>
                <p>info</p>
            </x-zeus-accordion::accordion.item>

            <x-zeus-accordion::accordion.item
                :label="__('Find Us')"
                icon="tabler-map-2"
            >
                <p>map</p>
            </x-zeus-accordion::accordion.item>

        </x-zeus-accordion::accordion>
    </div>
</x-filament-panels::page>
