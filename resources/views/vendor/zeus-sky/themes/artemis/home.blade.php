<div class="container px-8 mx-auto xl:px-5 max-w-screen-lg py-5 lg:py-8">
    @unless($stickies->isEmpty())
        <section class="grid gap-10 md:grid-cols-2 lg:gap-10">
            @each($theme.'.partial.sticky', $stickies->take(2), 'post')
        </section>
    @endunless

    <div class="my-10">
        @unless ($posts->isEmpty())
            <h1 class="text-xl font-bold text-gray-700 dark:text-gray-100 md:text-2xl">
                {{ __('Posts') }}
            </h1>

            @if(request()->filled('search'))
                {{ __('Showing Search result of') }}: <span class="highlight">{{ request('search') }}</span>
                <a title="{{ __('clear') }}" href="{{ route('blogs') }}">
                    <x-heroicon-o-backspace class="text-secondary-500 dark:text-secondary-100 w-4 h-4 inline-flex align-middle"/>
                </a>
            @endif

            <section class="mt-10 grid gap-10 md:grid-cols-2 lg:gap-10 xl:grid-cols-3 ">
                @each($theme.'.partial.post', $posts, 'post')
            </section>
        @else
            @include($theme.'.partial.empty')
        @endunless
    </div>

    <div class="mt-10 flex justify-center">
        <a href="/archive" class="relative inline-flex items-center gap-1 rounded-md border border-gray-300 bg-white px-3 py-2 pl-4 text-sm font-medium text-gray-500 hover:bg-gray-50 focus:z-20 disabled:pointer-events-none disabled:opacity-40 dark:border-gray-500 dark:bg-gray-800 dark:text-gray-300">
            <span>{{ __('View all Posts') }}</span>
        </a>
    </div>
</div>
