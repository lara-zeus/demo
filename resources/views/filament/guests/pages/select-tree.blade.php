<x-filament-panels::page>

    <x-guests.package-card
        name="Select Tree"
        vendor="codewithdennis"
        github="filament-select-tree"
        filament="https://filamentphp.com/plugins/codewithdennis-select-tree"
        image="https://filamentphp.com/images/content/plugins/images/codewithdennis-select-tree.webp"
    >
        <x-slot name="description">
            The multi-level select field lets you pick one or multiple options from a list<br> that's neatly organized into different levels.
        </x-slot>
    </x-guests.package-card>

    {{ $this->form }}
</x-filament-panels::page>
