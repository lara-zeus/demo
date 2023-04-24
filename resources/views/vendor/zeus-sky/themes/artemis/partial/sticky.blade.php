<div class="group cursor-pointer">
    @if($post->image() !== null)
        <div class="overflow-hidden rounded-md bg-gray-100 transition-all hover:scale-105 dark:bg-gray-800">
            <a class="relative block aspect-video" href="{{ route('post',$post->slug) }}">
                <img src="{{ $post->image() }}" alt="{{ $post->title }}" class="absolute h-full w-full object-cover transition-all">
            </a>
        </div>
    @endif

    <h2 class="text-lg font-semibold leading-snug tracking-tight mt-2 dark:text-white">
        <a href="{{ route('post',$post->slug) }}">
            <span class="bg-gradient-to-r rtl:bg-gradient-to-r from-primary-200 to-primary-100 bg-[length:0px_10px] bg-left-bottom bg-no-repeat transition-[background-size] duration-500 hover:bg-[length:100%_3px] group-hover:bg-[length:100%_10px] dark:from-secondary-800 dark:to-secondary-900">
                {{ $post->title ?? '' }}
            </span>
        </a>
    </h2>
</div>
