<x-item>
    @slot('title')
        @svg('rpg-spear-head','h-10 w-10 text-secondary-500 sm:-mt-4')
        <span class="text-primary-500">Artemis</span>
    @endslot
    @slot('desc')
        @zeus Artemis | telling a story with a design. Themes for all Lara Zeus packages (SOON)
    @endslot
    @slot('btns')
        {{--<a href="{{ url('artemis') }}" class="rounded-md shadow w-full flex items-center justify-center text-base font-medium text-white bg-secondary-500 hover:bg-secondary-500 px-4 py-2">
            Read More
        </a>--}}
    @endslot
</x-item>
