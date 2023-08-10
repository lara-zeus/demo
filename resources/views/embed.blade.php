<x-app>
    <div class="container mx-auto my-4 space-y-6">
        <div>
            any text
        </div>
        <div class="w-1/3 mx-auto">
            @php
                $form = \LaraZeus\Bolt\Models\Form::first()
            @endphp
            @if($form !== null)
                <livewire:bolt.fill-form :slug="$form->slug" :inline="true"/>
            @endif
        </div>
        <div>
            any text
        </div>
    </div>
</x-app>

