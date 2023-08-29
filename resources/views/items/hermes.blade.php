<x-item>
    @slot('title')
        @svg('rpg-feather-wing','h-10 w-10 text-secondary-500 sm:-mt-4')
        <span class="text-primary-500">Hermes</span>
    @endslot
    @slot('desc')
        {{ __('Hermes | restaurants and cafés menu managements') }}
    @endslot
    @slot('btns')
        <a href="{{ url('/admin/branches') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-secondary-500 hover:bg-secondary-500 px-4 py-2 dark:bg-secondary-600 dark:hover:bg-secondary-800">
            {{ __('Admin Panel') }}
        </a>
        <a href="{{ url('hermes') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-primary-500 hover:bg-primary-700 px-4 py-2">
            {{ __('Our Menu') }}
        </a>
    @endslot
</x-item>
