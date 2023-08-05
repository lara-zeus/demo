<div class="navbar bg-base-100 shadow-xl rounded-2xl">
    {{--<div class="flex-none">
        <button class="btn btn-square btn-ghost">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-5 h-5 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
        </button>
    </div>--}}
    <div class="flex-1">
        <a class="flex gap-2 btn btn-ghost normal-case text-xl" href="{{ url('/') }}">
            <img class="w-7 mx-auto" src="https://larazeus.com/images/zeus-logo.png" alt="{{ config('zeus.wind.name', config('app.name', 'Laravel')) }}">
            @zeus
        </a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
            <li>
                <x-filament::dropdown placement="bottom-start" teleport="true">
                    <x-slot name="trigger"
                            class="dark:text-primary-200 text-primary-700 flex items-center justify-center gap-1">
                        {{ __('Site') }}
                        @svg('ri-arrow-down-s-fill','h-4 w-4 text-secondary-500 hover:text-primary-500 transition-all ease-in-out duration-300')
                    </x-slot>

                    <x-filament::dropdown.header
                        class="dark:text-gray-200 text-gray-700"
                        :color="'primary'"
                        :icon="'ri-global-fill'"
                        :href="'#'"
                        :tag="'a'"
                    >
                        Our Site:
                    </x-filament::dropdown.header>

                    <x-filament::dropdown.list>
                        <x-filament::dropdown.list.item
                            class="dark:text-gray-200 text-gray-700"
                            :color="'gray'"
                            :icon="'heroicon-m-chevron-right'"
                            :href="url('sky')"
                            tag="a"
                        >
                            {{ __('Blog') }}
                        </x-filament::dropdown.list.item>
                        <x-filament::dropdown.list.item
                            class="dark:text-gray-200 text-gray-700"
                            :color="'gray'"
                            :icon="'heroicon-m-chevron-right'"
                            :href="url('sky/faq')"
                            tag="a"
                        >
                            {{ __('Faq') }}
                        </x-filament::dropdown.list.item>
                        <x-filament::dropdown.list.item
                            class="dark:text-gray-200 text-gray-700"
                            :color="'gray'"
                            :icon="'heroicon-m-chevron-right'"
                            :href="url('sky/library')"
                            tag="a"
                        >
                            {{ __('Library') }}
                        </x-filament::dropdown.list.item>
                        <x-filament::dropdown.list.item
                            class="dark:text-gray-200 text-gray-700"
                            :color="'gray'"
                            :icon="'heroicon-m-chevron-right'"
                            :href="url('wind/contact-us')"
                            tag="a"
                        >
                            {{ __('Contact us') }}
                        </x-filament::dropdown.list.item>
                    </x-filament::dropdown.list>
                </x-filament::dropdown>
            </li>
            <li>
                <x-filament::dropdown placement="bottom-start" teleport="true">
                    <x-slot name="trigger"
                            class="dark:text-primary-200 text-primary-700 flex items-center justify-center gap-1">
                        {{ __('Forms') }}
                        @svg('ri-arrow-down-s-fill','h-4 w-4 text-secondary-500 hover:text-primary-500 transition-all ease-in-out duration-300')
                    </x-slot>

                    <x-filament::dropdown.list>
                        <x-filament::dropdown.list.item
                            class="dark:text-gray-200 text-gray-700"
                            :color="'gray'"
                            :icon="'heroicon-m-chevron-right'"
                            :href="url('bolt')"
                            tag="a"
                        >
                            {{ __('All Forms') }}
                        </x-filament::dropdown.list.item>
                        <x-filament::dropdown.list.item
                            class="dark:text-gray-200 text-gray-700"
                            :color="'gray'"
                            :icon="'heroicon-m-chevron-right'"
                            :href="url('bolt/entries')"
                            tag="a"
                        >
                            {{ __('My Entries') }}
                        </x-filament::dropdown.list.item>
                    </x-filament::dropdown.list>
                </x-filament::dropdown>
            </li>
            <li>
                <x-filament::dropdown placement="bottom-start" teleport="true">
                    <x-slot name="trigger" class="dark:text-primary-200 text-primary-700 flex items-center justify-center gap-1">
                        {{ __('Tickets') }}
                        @svg('ri-arrow-down-s-fill','h-4 w-4 text-secondary-500 hover:text-primary-500 transition-all ease-in-out duration-300')
                    </x-slot>

                    <x-filament::dropdown.list>
                        <x-filament::dropdown.list.item
                            class="dark:text-gray-200 text-gray-700"
                            :color="'gray'"
                            :icon="'heroicon-m-chevron-right'"
                            :href="url('thunder')"
                            tag="a"
                        >
                            {{ __('All Tickets') }}
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
                    </x-filament::dropdown.list>
                </x-filament::dropdown>
            </li>
            <li>
                <a class="" href="{{ url('/admin') }}">
                    {{ __('Admin') }}
                </a>
            </li>

            @include($artemisTheme.'.layouts.theme-switcher')
            @include($artemisTheme.'.layouts.lang-switcher')
            @include($artemisTheme.'.layouts.color-switcher')

            <li>
                <a href="https://github.com/lara-zeus" class="font-semibold" target="_blank" rel="noreferrer">
                    @svg('ri-github-fill','h-6 w-6')
                </a>
            </li>
        </ul>
    </div>
</div>
