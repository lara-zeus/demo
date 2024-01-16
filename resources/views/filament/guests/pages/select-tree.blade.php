<x-filament-panels::page>

    <x-filament::section>
        <x-slot name="heading">
            Select Tree Filament Plugin
        </x-slot>

        <x-slot name="description">
            The multi-level select field lets you pick one or multiple options from a list that's neatly organized into different levels.
        </x-slot>

        <img alt="Select Tree Filament Plugin" class="aspect-video mx-auto w-1/2" src="https://filamentphp.com/images/content/plugins/images/codewithdennis-select-tree.webp"/>

        <x-filament::link href="https://filamentphp.com/plugins/codewithdennis-select-tree">
            Select Tree
        </x-filament::link>
        Plugin

        by
        <x-filament::link href="https://github.com/CodeWithDennis">
            CodeWithDennis
        </x-filament::link>
    </x-filament::section>

    {{ $this->form }}
</x-filament-panels::page>
