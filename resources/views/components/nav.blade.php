<nav class="container mx-auto">
    <div class="flex justify-between px-2">
        <a href="{{ url('/') }}" class="flex items-center gap-2">
            <img class="w-7" src="{{ asset('images/zeus-logo.png') }}" alt="{{ config('zeus.wind.name', config('app.name', 'Laravel')) }}">
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">@zeus</span>
        </a>
        <button @click="open = !open" type="button"
                class="inline-flex sm:hidden items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary-500"
                aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <svg :class="{ 'hidden': open, 'block': !(open) }" class="h-6 w-6"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                 aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg x-cloak :class="{ 'block': open, 'hidden': !(open) }" class="h-6 w-6"
                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                 aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <div class="z-40 hidden sm:flex items-center justify-center gap-4">
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
                </x-filament::dropdown.list>
            </x-filament::dropdown>
            <x-filament::dropdown placement="bottom-start" teleport="true">
                <x-slot name="trigger"
                        class="dark:text-primary-200 text-primary-700 flex items-center justify-center gap-1">
                    {{ __('Apps') }}
                    @svg('ri-arrow-down-s-fill','h-4 w-4 text-secondary-500 hover:text-primary-500 transition-all ease-in-out duration-300')
                </x-slot>
                <x-filament::dropdown.list>
                    <x-filament::dropdown.list.item
                        class="dark:text-gray-200 text-gray-700"
                        :color="'gray'"
                        :icon="'heroicon-m-chevron-right'"
                        :href="url('wind/contact-us')"
                        tag="a"
                    >
                        {{ __('Contact us') }}
                    </x-filament::dropdown.list.item>
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
                        :href="url('thunder')"
                        tag="a"
                    >
                        {{ __('All Tickets') }}
                    </x-filament::dropdown.list.item>

                    <x-filament::dropdown.list.item
                        class="dark:text-gray-200 text-gray-700"
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
                <x-slot name="trigger" class="dark:text-primary-200 text-primary-700 flex items-center justify-center gap-1">
                    @auth()
                        <img x-tooltip="'User Profile'" src="{{ \Filament\Facades\Filament::getUserAvatarUrl(auth()->user()) }}" alt="avatar" class="object-cover w-10 h-10 rounded-full sm:block">
                    @else
                        Guest
                    @endauth
                </x-slot>

                <x-filament::dropdown.list>

                    <x-filament::dropdown.list.item
                        class="dark:text-gray-200 text-gray-700"
                        :color="'gray'"
                        :icon="'heroicon-m-chevron-right'"
                        :href="url('rain/new-page')"
                        tag="a"
                    >
                        {{ __('User Dashboard') }}
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

            <x-theme-switcher/>
            <x-lang-switcher/>
            <x-dark-mode/>
        </div>
    </div>
    <div x-show="open" @click.away="open = false" x-cloak class="" id="mobile-menu"
         x-transition:enter="duration-200 ease-out"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="duration-100 ease-in"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
    >
        <div class="mt-0 rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 bg-white dark:bg-gray-800 divide-y-2 divide-gray-50 mx-2">
            <div class="flex flex-col p-4 gap-4">
                <a href="{{ url('sky') }}"
                   class="whitespace-nowrap transition ease-in-out text-primary-500 dark:text-primary-200 hover:text-secondary-500 dark:hover:text-secondary-300">
                    {{ __('Blog') }}
                </a>
                <a href="{{ url('wind/contact-us') }}"
                   class="whitespace-nowrap transition ease-in-out text-primary-500 dark:text-primary-200 hover:text-secondary-500 dark:hover:text-secondary-300">
                    {{ __('Contact us') }}
                </a>
                <a href="{{ url('sky/faq') }}"
                   class="whitespace-nowrap transition ease-in-out text-primary-500 dark:text-primary-200 hover:text-secondary-500 dark:hover:text-secondary-300">
                    {{ __('Faq') }}
                </a>
                <a href="{{ url('sky/library') }}"
                   class="whitespace-nowrap transition ease-in-out text-primary-500 dark:text-primary-200 hover:text-secondary-500 dark:hover:text-secondary-300">
                    {{ __('Library') }}
                </a>
                <hr/>
                <a href="{{ url('/bolt') }}"
                   class="whitespace-nowrap transition ease-in-out text-primary-500 dark:text-primary-200 hover:text-secondary-500 dark:hover:text-secondary-300">
                    All Forms
                </a>
                <a href="{{ url('/bolt/entries') }}"
                   class="whitespace-nowrap transition ease-in-out text-primary-500 dark:text-primary-200 hover:text-secondary-500 dark:hover:text-secondary-300">
                    My Entries
                </a>
                <hr/>
                <a href="{{ url('/thunder') }}"
                   class="whitespace-nowrap transition ease-in-out text-primary-500 dark:text-primary-200 hover:text-secondary-500 dark:hover:text-secondary-300">
                    All Tickets
                </a>
                <a href="{{ url('/thunder/tickets') }}"
                   class="whitespace-nowrap transition ease-in-out text-primary-500 dark:text-primary-200 hover:text-secondary-500 dark:hover:text-secondary-300">
                    My Tickets
                </a>
                <hr/>
                <a href="{{ url('/admin') }}"
                   class="whitespace-nowrap transition ease-in-out text-primary-500 dark:text-primary-200 hover:text-secondary-500 dark:hover:text-secondary-300">
                    {{ __('Admin Panel') }}
                </a>

                <div class="flex gap-4 mt-4">
                    <x-lang-switcher/>
                    <x-dark-mode/>
                </div>

            </div>
        </div>
    </div>
</nav>
