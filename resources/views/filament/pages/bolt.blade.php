<div>
    @php
        $form = \LaraZeus\Bolt\Models\Form::first();
    @endphp
    <livewire:bolt.fill-form
        extensionSlug="printers-department"
        slug="printer-issues"
        inline="true"
    />
</div>
