<x-item>
    @slot('title')
        @svg('tabler-bow','h-10 w-10 text-secondary-500 sm:-mt-4')
        <span class="text-primary-500">Rhea</span>
    @endslot
    @slot('desc')
        Rhea is a tool that helps you migrate your wordpress blog to zeus sky.
    @endslot
    @slot('btns')
        <a href="{{ url('/admin/importer') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-secondary-500 hover:bg-secondary-500 px-4 py-2 dark:bg-secondary-600 dark:hover:bg-secondary-800">
            {{ __('Admin Panel') }}
        </a>
    @endslot
</x-item>
