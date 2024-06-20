<x-filament::section
    icon-color="primary"
    icon="clarity-tree-view-line">
    <x-slot name="heading">
        {{ $name }} Filament Plugin
    </x-slot>
    <x-slot name="headerEnd">
        @php
            $stars = cache()->remember('github-stars-'.$github,now()->addDay(),fn()=>\GrahamCampbell\GitHub\Facades\GitHub::repo()->show($vendor, $github)['stargazers_count'] ?? 0);
        @endphp
        <x-filament::button
            tooltip="github stars"
            icon="heroicon-m-star"
            href="https://github.com/{{ $vendor }}/{{ $github }}"
            tag="a"
        >
            {{ $stars }}
        </x-filament::button>
    </x-slot>
    <x-slot name="description">
        {{ $description }}
    </x-slot>

    <img alt="{{ $name }} Filament Plugin"
         class="my-4 aspect-video mx-auto "
         src="{{ $image }}"/>

    <p class="text-center">
        <x-filament::link href="{{ $filament }}">
            {{ $name }}
        </x-filament::link>
        Plugin

        by
        <x-filament::link href="https://github.com/{{ $vendor }}">
            {{ $vendor }}
        </x-filament::link>
    </p>
</x-filament::section>
