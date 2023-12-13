<div class="relative mx-2 gap-4 items-center justify-center flex">
    <span x-tooltip.raw='DB::migrate("fresh")->weekly()->days([0,2,4,6])->at("4:04")'>
        @svg('iconoir-warning-triangle','w-7 h-7 text-pink-600 cursor-pointer')
    </span>
    <x-lang-switcher/>
    <div x-tooltip.raw="Like the project? consider sponsoring me 😇">
        <x-filament::button
            color="secondary"
            icon="heroicon-o-heart"
            title="Sponsor atmonshi" tag="a" href="https://github.com/sponsors/atmonshi">
            <span>Sponsor</span>
        </x-filament::button>
    </div>
</div>
