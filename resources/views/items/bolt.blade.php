<x-item>
    @slot('title')
        <x-akar-thunder class="h-10 w-10 text-secondary-600 sm:-mt-4"/>
        <span class="text-primary-600">Bolt</span>
    @endslot
    @slot('desc')
        @zeus Bolt is a form builder for your users, with so many use cases.
    @endslot
    @slot('btns')
        <a href="{{ url('/admin/forms') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-secondary-500 hover:bg-secondary-600 px-4 py-2 dark:bg-secondary-700 dark:hover:bg-secondary-800">
            {{ __('Admin Panel') }}
        </a>

        <a href="{{ route('bolt.forms.list') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 px-4 py-2">
            Forms
        </a>
    @endslot
</x-item>
