<x-item>
    @slot('title')
        <x-ri-cloud-windy-line class="h-10 w-10 text-secondary-600 sm:-mt-4"/>
        <span class="text-primary-600">Sky</span>
    @endslot
    @slot('desc')
        @zeus Sky is simple CMS for your website. It includes posts, pages, tags, and categories.
    @endslot
    @slot('btns')
        <a href="{{ url('/admin/posts') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-secondary-500 hover:bg-secondary-600 px-4 py-2 dark:bg-secondary-700 dark:hover:bg-secondary-800">
            {{ __('Admin Panel') }}
        </a>

        <a href="{{ url('sky') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 px-4 py-2">
            Blog
        </a>
    @endslot
</x-item>
