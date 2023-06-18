<x-item>
    @slot('title')
        <x-tabler-bow class="h-10 w-10 text-secondary-600 sm:-mt-4"/>
        <span class="text-primary-600">Rhea</span>
    @endslot
    @slot('desc')
        @zeus Rhea is a tool that helps you migrate your wrodpress blog to zeus sky.
    @endslot
    @slot('btns')
        <a href="{{ url('/admin/importer') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-secondary-500 hover:bg-secondary-600 px-4 py-2 dark:bg-secondary-700 dark:hover:bg-secondary-800">
            Admin Panel
        </a>
    @endslot
</x-item>
