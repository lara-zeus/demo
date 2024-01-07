<div class="relative mx-2 gap-4 items-center justify-center flex">
    <span
        x-tooltip="{
                    content: 'DB::migrate(&quot;fresh&quot;)->weekly()->days([0,2,4,6])->at(&quot;4:04&quot;)',
                    theme: $store.theme,
                }"
    >
        @svg('iconoir-warning-triangle','w-7 h-7 text-pink-600 cursor-pointer')
    </span>
    <x-lang-switcher/>
    <div
        x-tooltip="{
                    content: 'Like the project? consider sponsoring me 😇',
                    theme: $store.theme,
                }">
        <x-filament::button
            color="secondary"
            icon="heroicon-o-heart"
            title="Sponsor atmonshi" tag="a" href="https://github.com/sponsors/atmonshi">
            <span>Sponsor</span>
        </x-filament::button>
    </div>
</div>
