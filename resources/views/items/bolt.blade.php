<x-item>
    @slot('title')
        @svg('akar-thunder','h-10 w-10 text-secondary-500 sm:-mt-4')
        <span class="text-primary-500">Bolt</span>
    @endslot
    @slot('desc')
        Bolt is a form builder for your users, with so many use cases.
    @endslot
    @slot('btns')
        <a href="{{ url('/admin/forms') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-secondary-500 hover:bg-secondary-500 px-4 py-2 dark:bg-secondary-600 dark:hover:bg-secondary-800">
            {{ __('Admin Panel') }}
        </a>

        <a href="{{ route('bolt.forms.list') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-primary-500 hover:bg-primary-700 px-4 py-2">
            Forms
        </a>
    @endslot
</x-item>
