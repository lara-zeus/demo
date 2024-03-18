<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div class="max-w-4xl my-2 grid grid-cols-1 sm:grid-cols-3 lg:grid-cols-4 gap-2"
         x-data="{ state: $wire.entangle('{{ $getStatePath() }}').defer }"
    >
        @foreach(\App\Models\Car::get() as $car)
            <label>
                <input wire:model="{{ $getStatePath() }}" type="radio" class="checkbox-input" name="group" value="{{ $car->id }}" />
                <span class="checkbox-tile hover:border-custom-500 p-2">
                    <span class="text-custom-600 dark:text-custom-500 flex flex-col items-center justify-center gap-2">
                        <img alt="{{ $car->name }}" class="rounded-md aspect-square object-cover" src="{{ \Illuminate\Support\Facades\Storage::url($car->image) }}"/>
                        {{ $car->name }}
                    </span>
                </span>
            </label>
        @endforeach
    </div>
</x-dynamic-component>
