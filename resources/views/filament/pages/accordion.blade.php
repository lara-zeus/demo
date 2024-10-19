<x-filament-panels::page>
    <div class="mb-6">
        <h3 class="my-4 text-lg capitalize">Using Accordion In Forms</h3>
        {{ $this->form }}
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
                icon="clarity-contract-line"
            >
                <div class="dark:bg-gray-900 bg-white p-4 *:py-2">
                    <p>title</p>
                    <p>title</p>
                </div>
            </x-zeus-accordion::accordion.item>

            <x-zeus-accordion::accordion.item
                :label="__('Call Us')"
                icon="clarity-envelope-line"
                badge="New Item"
                badgeColor="danger"
            >
                <div class="dark:bg-gray-900 items-center justify-center bg-white p-4 *:py-2">
                    <p>info</p>
                    <p>info</p>
                    <p>info</p>
                </div>
            </x-zeus-accordion::accordion.item>

            <x-zeus-accordion::accordion.item
                :label="__('Find Us')"
                icon="clarity-map-outline-badged"
            >
                <div class="dark:bg-gray-900 items-center justify-center bg-white p-4 *:py-2">
                    <p>map</p>
                </div>
            </x-zeus-accordion::accordion.item>

        </x-zeus-accordion::accordion>
    </div>
</x-filament-panels::page>
