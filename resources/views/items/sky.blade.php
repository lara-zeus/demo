<x-item>
    @slot('title')
        @svg('ri-cloud-windy-line','h-10 w-10 text-secondary-500 sm:-mt-4')
        <span class="text-primary-500">Sky</span>
    @endslot
    @slot('desc')
        Sky is simple CMS for your website. It includes posts, pages, tags, and categories.
    @endslot
    @slot('btns')
        <a href="{{ url('/admin/posts') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-secondary-500 hover:bg-secondary-500 px-4 py-2 dark:bg-secondary-600 dark:hover:bg-secondary-800">
            {{ __('Admin Panel') }}
        </a>

        <a href="{{ route('blogs') }}" class="shadow transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-white bg-primary-500 hover:bg-primary-700 px-4 py-2">
            Blog
        </a>
    @endslot
</x-item>
