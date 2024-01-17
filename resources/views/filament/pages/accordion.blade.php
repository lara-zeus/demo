<x-filament-panels::page>
    {{ $this->form }}

    <br>

    <div class="my-10">
        <h3 class="my-4 text-lg mx-4">using accordion as a blade component</h3>
        <x-zeus-accordion::accordion activeAccordion="1">
            <x-zeus-accordion::accordion.item
                :label="__('Contact Us')"
                icon="clarity-contract-line"
            >
                <div class="bg-white p-4 *:py-2">
                    <p>title</p>
                    <p>title</p>
                </div>
            </x-zeus-accordion::accordion.item>

            <x-zeus-accordion::accordion.item
                :label="__('Call Us')"
                icon="clarity-envelope-line"
            >
                <div class="bg-white p-4 *:py-2">
                    <p>info</p>
                    <p>info</p>
                    <p>info</p>
                </div>
            </x-zeus-accordion::accordion.item>

            <x-zeus-accordion::accordion.item
                :label="__('Find Us')"
                icon="clarity-map-outline-badged"
            >
                <div class="bg-white p-4 *:py-2">
                    <p>map</p>
                </div>
            </x-zeus-accordion::accordion.item>

        </x-zeus-accordion::accordion>
    </div>
</x-filament-panels::page>
