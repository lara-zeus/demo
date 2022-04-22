<div
        x-data="{
        isOpen: false,

        mode: null,

        theme: null,

        init: function () {
            this.theme = localStorage.getItem('theme') || (this.isSystemDark() ? 'dark' : 'light')
            this.mode = localStorage.getItem('theme') ? 'manual' : 'auto'

            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (event) => {
                if (this.mode === 'manual') return

                if (event.matches && (! document.documentElement.classList.contains('dark'))) {
                    this.theme = 'dark'

                    document.documentElement.classList.add('dark')
                } else if ((! event.matches) && document.documentElement.classList.contains('dark')) {
                    this.theme = 'light'

                    document.documentElement.classList.remove('dark')
                }
            })

            $watch('theme', () => {
                if (this.mode === 'auto') return

                localStorage.setItem('theme', this.theme)

                if (this.theme === 'dark' && (! document.documentElement.classList.contains('dark'))) {
                    document.documentElement.classList.add('dark')
                } else if (this.theme === 'light' && document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark')
                }

                $dispatch('dark-mode-toggled', this.theme)
            })
        },

        isSystemDark: function () {
            return window.matchMedia('(prefers-color-scheme: dark)').matches
        },
    }"
        class="relative"
>
    <button
            x-on:click="isOpen = ! isOpen"
            @class([
                'block flex-shrink-0 w-10 h-10 rounded-full bg-gray-50 bg-cover bg-center',
                'dark:bg-gray-900' => config('filament.dark_mode'),
            ])
    ><x-ri-translate class="w-6 h-6 mx-auto text-secondary-500" /></button>

    <div
            x-show="isOpen"
            x-on:click.away="isOpen = false"
            x-transition:enter="transition"
            x-transition:enter-start="-translate-y-1 opacity-0"
            x-transition:enter-end="translate-y-0 opacity-100"
            x-transition:leave="transition"
            x-transition:leave-start="translate-y-0 opacity-100"
            x-transition:leave-end="-translate-y-1 opacity-0"
            x-cloak
            class="absolute z-10 right-0 rtl:right-auto rtl:left-0 mt-2 shadow-xl rounded-xl w-52 top-full"
    >
        <ul @class([
            'py-1 space-y-1 overflow-hidden bg-white shadow rounded-xl',
            'dark:border-gray-600 dark:bg-gray-700' => config('filament.dark_mode'),
        ])>
            @foreach(config('app.locales') as $local)
                <x-filament::dropdown.item
                        :color="'secondary'"
                        :icon="'iconpark-dot'"
                        :href="url('lang/'.$local)"
                        tag="a"
                >
                    {{ __($local) }}
                </x-filament::dropdown.item>
            @endforeach
        </ul>
    </div>
</div>
