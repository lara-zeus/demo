<x-app>
    <div class="container mx-auto my-4 space-y-6">
        <div class="flex gap-2">
            <div class="w-1/2 mx-auto">
                <h3>Embed with LW</h3>
                @php
                    $form = \LaraZeus\Bolt\Models\Form::first();
                    $office = \LaraZeus\Thunder\Models\Office::first();
                @endphp
                @if($form !== null)
                    <livewire:bolt.fill-form
                        :extensionSlug="$office"
                        :slug="$office->form->slug"
                        :inline="true"
                    />
                @endif
            </div>
            <div class="w-1/2 mx-auto">
                <h3>Embed with iframe</h3>
                <iframe class="bord" height="500" src="https://larazeus.com/bolt/embed/{{ $form->slug }}"></iframe>
            </div>
        </div>
        <div>
            any text
        </div>
    </div>
</x-app>

