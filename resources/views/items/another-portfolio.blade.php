@php
    $deg = ($loop->even) ? '-' : '';
@endphp
<div class="card p-4 bg-[#f8f3e8] dark:bg-gray-800 border border-[#bdaf91] dark:border-gray-700 shadow-xl rounded-lg"
     style="transform:rotate({{$deg}}{{rand(1,15.9)}}deg);">

    <div class="flex items-center justify-center gap-4 font-[Kalam] text-gray-700 dark:text-gray-400">
        @svg($package['icon'],'h-16 w-16 text-secondary-500')
        <h2 class="mt-2 text-5xl">{{ $package['name'] }}</h2>
    </div>

    <p class="py-4 text-3xl font-[Kalam] text-center text-primary-700 dark:text-primary-200">{{ $package['desc'] }}</p>

    <div class="px-2 py-4 flex gap-6 mx-auto mb-6">
        @if($package['admin_url'] !== null)
            <a href="{{ $package['admin_url'] }}" class="text-primary-600 hover:text-secondary-500 transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-gray-900">
                {{ __('Admin Panel') }}
            </a>
        @endif

        @if($package['fe_url'] !== null)
            <a href="{{ $package['fe_url'] }}" class="text-primary-600 hover:text-secondary-500 transition ease-in-out whitespace-nowrap text-base font-medium rounded-md text-gray-900">
                {{ $package['fe_text'] }}
            </a>
        @endif
    </div>
</div>
