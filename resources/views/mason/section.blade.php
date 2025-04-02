@props([
    'id' => null,
    'background_color' => null,
    'text' => null,
    'image' => null,
])
<div class="p-2 {{ $background_color ?? 'bg-white' }}">
    <section>
        <div class="mx-auto max-w-screen-xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:items-center md:gap-8">
                <div>
                    <div class="max-w-lg md:max-w-none">
                        <p class="mt-4 text-gray-700">
                            {!! $text !!}
                        </p>
                    </div>
                </div>

                <div>
                    <img
                            src="{{ \Illuminate\Support\Facades\Storage::url($image) }}"
                            class="rounded"
                            alt=""
                    />
                </div>
            </div>
        </div>
    </section>
</div>
