<x-item>
    @slot('title')
        <span class="text-primary-500">{{ $package['name'] }}</span>
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
            <a href="{{ $package['admin_url'] }}" class="shadow whitespace-nowrap font-medium rounded-md text-gray-800 bg-white hover:bg-gray-500 px-4 py-2 dark:bg-gray-600 dark:hover:bg-gray-800 transition-all ease-in-out duration-300">
                {{ __('Admin Panel') }}
            </a>
        @endif

        @if($package['fe_url'] !== null)
            <a href="{{ $package['fe_url'] }}" class="shadow whitespace-nowrap font-medium rounded-md text-white bg-primary-500 hover:bg-primary-700 px-4 py-2 transition-all ease-in-out duration-300">
                {{ $package['fe_text'] }}
            </a>
        @endif
    @endslot
</x-item>
