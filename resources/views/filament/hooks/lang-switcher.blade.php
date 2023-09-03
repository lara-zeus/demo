<div class="relative mx-2 gap-4 items-center justify-center flex">
    <x-lang-switcher/>
    @if(app()->isLocal()) <x-theme-switcher/> @endif
    <div x-tooltip.raw="Like the project? consider sponsoring me 😇">
        <x-filament::button
            color="secondary"
            icon="heroicon-o-heart"
            title="Sponsor atmonshi" tag="a" href="https://github.com/sponsors/atmonshi">
            <span>Sponsor</span>
        </x-filament::button>
    </div>
</div>
