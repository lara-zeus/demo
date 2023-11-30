<x-filament::page>
    <div class="flex items-stretch justify-center gap-4">
        <div class="w-full lg:w-1/2">
            {{ $this->form }}
        </div>
        <div class="w-full lg:w-1/2">
            <x-filament::section>
                <x-slot name="heading">
                    Preview
                </x-slot>

                <div id="qrcode" class="text-center flex justify-center items-center">
                    {!! \App\Filament\Pages\QrCode::maketheqr($this->form->getState()) !!}
                </div>

                <x-slot name="headerEnd">
                    <x-filament::button type="button" @click="download('{{ 'sssss' }}')">
                        Download
                    </x-filament::button>
                </x-slot>
            </x-filament::section>
        </div>
    </div>

    {{--better to use @push...--}}
    <script src="{{ asset('js/qrcode.js') }}"></script>
</x-filament::page>
