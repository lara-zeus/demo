<div>
    <span class="hover:border-custom-500 p-2">
        <span class="text-custom-600 dark:text-custom-500 flex flex-col items-center justify-center gap-2">
            <img alt="{{ $car->name }}" class="rounded-md aspect-square object-cover" src="{{ \Illuminate\Support\Facades\Storage::url($car->image) }}"/>
            {{ $car->name }}
        </span>
    </span>
</div>