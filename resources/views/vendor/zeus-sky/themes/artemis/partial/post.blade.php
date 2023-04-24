<div>
    @if($post->image() !== null)
        <div class="overflow-hidden rounded-md bg-gray-100 transition-all hover:scale-105 dark:bg-gray-800">
            <a class="relative block aspect-square" href="{{ route('post',$post->slug) }}">
                <img alt="{{ $post->title }}" class="object-cover transition-all h-full w-full" src="{{ $post->image() ?? config('zeus-sky.default_featured_image') }}">
            </a>
        </div>
    @endif

    @unless ($post->tags->isEmpty())
        <div class="flex gap-3">
            @each($theme.'.partial.tag', $post->tags->where('type','category'), 'tag')
        </div>
    @endunless

    <h2 class="text-lg font-semibold leading-snug tracking-tight mt-2    dark:text-white">
        <a href="{{ route('post',$post->slug) }}">
            <span class="bg-gradient-to-r rtl:bg-gradient-to-r from-primary-200 to-primary-100 bg-[length:0px_10px] bg-left-bottom bg-no-repeat transition-[background-size] duration-500 hover:bg-[length:100%_3px] group-hover:bg-[length:100%_10px] dark:from-secondary-800 dark:to-secondary-900">
                {!! $post->title !!}
            </span>
        </a>
    </h2>

    @if($post->description !== null)
        <p class="h-20 mt-2 line-clamp-3 text-sm text-gray-500 dark:text-gray-400">
            <a href="{{ route('post',$post->slug) }}">
                {!! $post->description !!}
            </a>
        </p>
    @endif

    <div class="mt-3 flex items-center space-x-3 text-gray-500 dark:text-gray-400">
        <div class="flex items-center gap-3">
            <div class="relative h-5 w-5 flex-shrink-0">
                <img src="{{ \Filament\Facades\Filament::getUserAvatarUrl($post->author) }}" alt="avatar" class="rounded-full object-cover">
            </div>
            <span class="truncate text-sm">
                {{ $post->author->name ?? '' }}
            </span>
        </div>
        <span class="text-xs text-gray-300 dark:text-gray-600">•</span>
        <time class="truncate text-sm" datetime="2022-10-21T06:05:00.000Z">
            {{ optional($post->published_at)->diffForHumans() ?? '' }}
        </time>
    </div>
</div>
