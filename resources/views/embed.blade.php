<x-app>
    <div class="container mx-auto my-4 space-y-6">
        <div class="flex gap-2">
            <div class="w-1/2 mx-auto">
                <h3>Embed with LW</h3>
                @php
                    $form = \LaraZeus\Bolt\Models\Form::first()
                @endphp
                @if($form !== null)
                    <livewire:bolt.fill-form
                        extensionSlug="printers-department"
                        slug="printer-issues"
                        :inline="true"
                    />
                @endif
            </div>
            <div class="w-1/2 mx-auto">
                <h3>Embed with iframe</h3>
                <iframe height="500" src="{{ url('bolt/embed/'.$form->slug) }}"></iframe>
            </div>
        </div>
        <div>
            any text
        </div>
    </div>
</x-app>

