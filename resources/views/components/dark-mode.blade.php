<div
        x-data="{
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
                    }">

                <span x-cloak x-show="theme === 'dark' || theme === 'system'" x-on:click="mode = 'manual'; theme = 'light'" class="cursor-pointer">
                    @svg('heroicon-s-moon','h-6 w-6 md:h-8 md:w-8 text-secondary-500 hover:text-primary-500 transition-all ease-in-out duration-300')
                </span>
                <span x-cloak x-show="theme === 'light'" x-on:click="mode = 'manual'; theme = 'dark'" class="cursor-pointer">
                    @svg('heroicon-s-sun','h-6 w-6 md:h-8 md:w-8 text-secondary-500 hover:text-primary-500 transition-all ease-in-out duration-300')
                </span>
</div>
