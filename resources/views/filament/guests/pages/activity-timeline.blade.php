<x-filament-panels::page>

    <x-filament::section>
        <x-slot name="heading">
            Activity Timeline Filament Plugin
        </x-slot>

        <x-slot name="description">
            Activity Timeline plugin conveniently presents upcoming, ongoing, and past activities, offering a comprehensive view of events.
        </x-slot>

        <x-filament::link href="https://filamentphp.com/plugins/jaocero-activity-timeline">
            Activity Timeline
        </x-filament::link>
        Plugin

        by
        <x-filament::link href="https://github.com/199ocero">
            Jay-Are Ocero
        </x-filament::link>

        <img alt="Activity Timeline Filament Plugin" class="my-10 aspect-video mx-auto w-1/2" src="https://filamentphp.com/images/content/plugins/images/jaocero-activity-timeline.webp"/>


    </x-filament::section>

    {{ $this->infolist }}
</x-filament-panels::page>
