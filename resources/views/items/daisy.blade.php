<x-item-daisy>
    @slot('title')
        @svg($package['icon'],'h-10 w-10 text-secondary-500 dark:text-secondary-400 sm:-mt-4')
        <span class="text-primary-500 dark:text-primary-300">{{ $package['name'] }}</span>
    @endslot
    @slot('desc')
        {{ $package['desc'] }}
    @endslot
    @slot('btns')
        @if($package['admin_url'] !== null)
            <a href="{{ $package['admin_url'] }}" class="btn btn-sm">
                {{ __('Admin Panel') }}
            </a>
        @endif

        @if($package['fe_url'] !== null)
            <a href="{{ $package['fe_url'] }}" class="btn btn-accent dark:btn-base btn-sm">
                {{ $package['fe_text'] }}
            </a>
        @endif
    @endslot
</x-item-daisy>
