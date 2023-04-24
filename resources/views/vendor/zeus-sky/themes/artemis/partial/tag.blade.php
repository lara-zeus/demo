<a href="{{ route('tags',['category',$tag->slug]) }}">
    <span class="inline-block text-xs font-medium tracking-wider uppercase mt-5 text-secondary-600">
        {{ $tag->name ?? '' }}
    </span>
</a>
