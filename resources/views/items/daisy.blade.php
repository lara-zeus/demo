<x-item-daisy>
    @slot('title')
        @svg($package['icon'],'h-10 w-10 text-secondary-500 dark:text-secondary-400 sm:-mt-4')
        <span class="text-primary-500 dark:text-primary-300">{{ $package['name'] }}</span>
    @endslot
    @slot('desc')
        {{ $package['desc'] }}

        <div>
            @if($package['other'] !== null)
                @php
                    $others = json_decode($package['other'],true);
                @endphp
                <p class="py-2">
                    {{ $others['title'] }}
                </p>
                <ul class="px-2 space-y-1">
                    @foreach($others['urls'] as $url)
                        <li>
                            <a href="{{ $url['url'] }}" class="text-primary-600 hover:text-secondary-500 transition ease-in-out whitespace-nowrap text-base font-medium rounded-md">
                                {{ $url['text'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
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
