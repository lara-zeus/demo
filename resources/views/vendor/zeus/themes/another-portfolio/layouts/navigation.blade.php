<div class="w-full mx-auto mb-10 pt-32 gap-4 flex justify-between items-center px-10 py-4">
    <a href="{{ url('/') }}" class="w-1/4 text-secondary-400 text-xl whitespace-nowrap">
        <span class="group"><span class="text-secondary-400 group-hover:text-custom-400 transition ease-in-out duration-300">Lara&nbsp;<span class="line-through italic text-custom-400 group-hover:text-secondary-400 transition ease-in-out duration-300">Z</span>eus</span> Demo</span>
    </a>
    <div class="w-full flex items-center justify-end gap-2">
        @php $menu = \LaraZeus\Sky\Models\Navigation::fromHandle(config('zeus.header_menu')); @endphp
        @if($menu !== null)
            @foreach($menu->items as $item)
                {!! \LaraZeus\Sky\Classes\RenderNavItem::render($item,'px-3 py-2 text-lg font-karla text-custom-500 hover:text-secondary-500 dark:text-gray-400 transition-all ease-in-out duration-300') !!}
            @endforeach
        @endif

        <x-filament::dropdown placement="bottom-start" teleport="true">
            <x-slot name="trigger"
                    class="dark:text-custom-200 text-custom-500 flex items-center justify-center gap-1">
                {{ __('Site') }}
                @svg('ri-arrow-down-s-fill','h-4 w-4 text-secondary-500 hover:text-custom-500 transition-all ease-in-out duration-300')
            </x-slot>

            <x-filament::dropdown.header
                class="dark:text-gray-200 text-gray-500"
                :color="'primary'"
                :icon="'ri-global-fill'"
                :href="'#'"
                :tag="'a'"
            >
                Our Site:
            </x-filament::dropdown.header>

            <x-filament::dropdown.list>
                <x-filament::dropdown.list.item
                    class="dark:text-gray-200 text-gray-500"
                    :color="'gray'"
                    :icon="'heroicon-m-chevron-right'"
                    :href="url('sky')"
                    tag="a"
                >
                    {{ __('Blog') }}
                </x-filament::dropdown.list.item>
                <x-filament::dropdown.list.item
                    class="dark:text-gray-200 text-gray-500"
                    :color="'gray'"
                    :icon="'heroicon-m-chevron-right'"
                    :href="url('sky/faq')"
                    tag="a"
                >
                    {{ __('Faq') }}
                </x-filament::dropdown.list.item>
                <x-filament::dropdown.list.item
                    class="dark:text-gray-200 text-gray-500"
                    :color="'gray'"
                    :icon="'heroicon-m-chevron-right'"
                    :href="url('sky/library')"
                    tag="a"
                >
                    {{ __('Library') }}
                </x-filament::dropdown.list.item>
            </x-filament::dropdown.list>
        </x-filament::dropdown>
        <x-filament::dropdown placement="bottom-start" teleport="true">
            <x-slot name="trigger"
                    class="dark:text-custom-200 text-custom-500 flex items-center justify-center gap-1">
                {{ __('Apps') }}
                @svg('ri-arrow-down-s-fill','h-4 w-4 text-secondary-500 hover:text-custom-500 transition-all ease-in-out duration-300')
            </x-slot>
            <x-filament::dropdown.list>
                <x-filament::dropdown.list.item
                    class="dark:text-gray-200 text-gray-500"
                    :color="'gray'"
                    :icon="'heroicon-m-chevron-right'"
                    :href="url('wind/contact-us')"
                    tag="a"
                >
                    {{ __('Contact us') }}
                </x-filament::dropdown.list.item>
                <x-filament::dropdown.list.item
                    class="dark:text-gray-200 text-gray-500"
                    :color="'gray'"
                    :icon="'heroicon-m-chevron-right'"
                    :href="url('bolt')"
                    tag="a"
                >
                    {{ __('All Forms') }}
                </x-filament::dropdown.list.item>
                <x-filament::dropdown.list.item
                    class="dark:text-gray-200 text-gray-500"
                    :color="'gray'"
                    :icon="'heroicon-m-chevron-right'"
                    :href="url('thunder')"
                    tag="a"
                >
                    {{ __('All Tickets') }}
                </x-filament::dropdown.list.item>

                <x-filament::dropdown.list.item
                    class="dark:text-gray-200 text-gray-500"
                    :color="'gray'"
                    :icon="'heroicon-m-chevron-right'"
                    :href="url('hermes')"
                    tag="a"
                >
                    {{ __('Branches & Menus') }}
                </x-filament::dropdown.list.item>

            </x-filament::dropdown.list>
        </x-filament::dropdown>

        <x-filament::button tag="a" size="xs" href="{{ url('/admin') }}">
            {{ __('Admin') }}
        </x-filament::button>

        <x-filament::dropdown placement="bottom-start" teleport="true">
            <x-slot name="trigger" class="dark:text-custom-200 text-custom-500 flex items-center justify-center gap-1">
                @auth()
                    <img x-tooltip="'User Profile'" src="{{ \Filament\Facades\Filament::getUserAvatarUrl(auth()->user()) }}" alt="avatar" class="object-cover w-10 h-10 rounded-full sm:block">
                @else
                    Guest
                @endauth
            </x-slot>

            <x-filament::dropdown.list>

                <x-filament::dropdown.list.item
                    class="dark:text-gray-200 text-gray-500"
                    :color="'gray'"
                    :icon="'heroicon-m-chevron-right'"
                    :href="url('dynamic-dashboard/new-page')"
                    tag="a"
                >
                    {{ __('User Dashboard') }}
                </x-filament::dropdown.list.item>

                <x-filament::dropdown.list.item
                    class="dark:text-gray-200 text-gray-500"
                    :color="'gray'"
                    :icon="'heroicon-m-chevron-right'"
                    :href="url('thunder/tickets')"
                    tag="a"
                >
                    {{ __('My Tickets') }}
                </x-filament::dropdown.list.item>

                <x-filament::dropdown.list.item
                    class="dark:text-gray-200 text-gray-500"
                    :color="'gray'"
                    :icon="'heroicon-m-chevron-right'"
                    :href="url('bolt/entries')"
                    tag="a"
                >
                    {{ __('My Entries') }}
                </x-filament::dropdown.list.item>
            </x-filament::dropdown.list>
        </x-filament::dropdown>

        <x-theme-switcher/>
        <x-lang-switcher/>
        <x-dark-mode/>
    </div>
</div>
