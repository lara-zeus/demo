@props([
    'id' => null,
    'background_color' => 'white',
    'cards' => [],
])

<x-section :bg-color="$background_color">
    <div class="mx-auto w-full max-w-5xl px-6 py-8 @3xl:py-12">
        @if ($cards)
            <ul class="grid w-full list-none gap-6 px-0 text-neutral-900 @3xl:grid-cols-2 @5xl:grid-cols-3">
                @foreach ($cards as $card)
                    <li class="h-full">
                        <x-card color="white" class="h-full">
                            @if($card['heading'])
                                <x-slot name="heading">
                                    {{ $card['heading'] }}
                                </x-slot>
                            @endif

                            <div class="prose max-w-none prose-headings:font-display">
                                {!! $card['body'] !!}
                            </div>

                            @if($card['footer'])
                                <x-slot name="footer">
                                    {{ $card['footer'] }}
                                </x-slot>
                            @endif
                        </x-card>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</x-section>