<x-item>
    @slot('title')
        <x-akar-thunder class="h-10 w-10 text-secondary-600 sm:-mt-4"/>
        <span class="text-primary-600">Bolt</span>
    @endslot
    @slot('desc')
        @zeus Bolt is a form builder for your users, with so many use cases.
    @endslot
    @slot('btns')
        <div class="rounded-md shadow">
            <a href="{{ url('/admin/forms') }}" class="transition ease-in-out w-full flex items-center justify-center px-8 py-3 text-base font-medium rounded-md text-white bg-secondary-500 hover:bg-secondary-600 px-4 py-2">
                Admin Panel
            </a>
        </div>
        <div class="mt-3 sm:mt-0 sm:mx-3">
            <a href="{{ route('bolt.user.forms.list') }}" class="transition ease-in-out w-full flex items-center justify-center px-8 py-3 text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 px-4 py-2">
                Forms List
            </a>
        </div>
    @endslot
</x-item>
