<x-filament-panels::page>
    <form wire:submit="create">
        <div class="mb-6">
            <h3 class="my-4 text-lg capitalize">Using Mark In Forms</h3>

            {{ $this->form }}

            <x-filament::button class="my-4" type="submit">
                submit
            </x-filament::button>
        </div>
    </form>

    <h2 class="text-xl">Likes From Sky Posts</h2>
    <p>
        Browse the
        <x-filament::link target="_blank" href="{{ url('/sky') }}">
            posts
        </x-filament::link>
        and like them to see it in action here
    </p>

</x-filament-panels::page>
