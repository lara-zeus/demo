<li title="Change Theme" class="dropdown">
    <details>
        <summary>
            @auth()
                <img x-tooltip="'User Profile'" src="{{ \Filament\Facades\Filament::getUserAvatarUrl(auth()->user()) }}" class="h-5 w-5" alt="avatar">
            @else
                Guest
            @endauth
        </summary>
        <ul class="z-50 dropdown-content bg-base-200 text-base-content rounded-box w-56 overflow-y-auto shadow">
            <div class="grid grid-cols-1 gap-3 p-3" tabindex="0">
                <x-filament::dropdown.list.item
                    class="dark:text-gray-200 text-gray-700"
                    :color="'gray'"
                    :icon="'heroicon-m-chevron-right'"
                    :href="url('bolt/entries')"
                    tag="a"
                >
                    {{ __('My Entries') }}
                </x-filament::dropdown.list.item>
                <x-filament::dropdown.list.item
                    class="dark:text-gray-200 text-gray-700"
                    :color="'gray'"
                    :icon="'heroicon-m-chevron-right'"
                    :href="url('thunder/tickets')"
                    tag="a"
                >
                    {{ __('My Tickets') }}
                </x-filament::dropdown.list.item>
            </div>
        </ul>
    </details>
</li>
