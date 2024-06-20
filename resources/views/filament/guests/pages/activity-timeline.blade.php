<x-filament-panels::page>

    <x-guests.package-card
        name="Activity Timeline"
        vendor="199ocero"
        github="activity-timeline"
        filament="https://filamentphp.com/plugins/jaocero-activity-timeline"
        image="https://filamentphp.com/images/content/plugins/images/jaocero-activity-timeline.webp"
    >
        <x-slot name="description">
            Activity Timeline plugin conveniently presents upcoming, ongoing, and past activities, offering a comprehensive view of events.
        </x-slot>
    </x-guests.package-card>

    {{ $this->infolist }}
</x-filament-panels::page>
