<x-filament::page>
    {{ $this->table }}

    <div class="my-10">
        <h3 class="my-4 text-lg mx-4">using popover in infolist</h3>
        {{ $this->infolist }}
    </div>

    <div class="my-10">
        <h3 class="my-4 text-lg mx-4">using popover in forms</h3>
        {{ $this->form }}
    </div>
</x-filament::page>
