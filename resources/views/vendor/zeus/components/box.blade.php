<div
        {{ $attributes->merge([
            'class' => 'mt-4 bg-white rounded-lg border border-gray-200'.
            ($attributes->get('shadowless') ? ' ' : ' shadow-lg')
            ]) }}
>
    @if(isset($header))
        <div class="bg-gray-50 rounded-t-lg p-4 border-b border-gray-200">
            {{ $header }}
        </div>
    @endif
    <div class="p-4">
        {{ $slot }}
    </div>
    @if(isset($footer))
        <div class="bg-gray-00 rounded-b-lg p-2 border-t border-gray-200">
            {{ $footer }}
        </div>
    @endif
</div>
