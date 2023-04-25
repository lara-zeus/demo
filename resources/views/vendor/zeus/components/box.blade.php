<div
        {{ $attributes->merge([
            'class' => 'mt-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-800'.
            ($attributes->get('shadowless') ? ' ' : ' shadow-lg')
            ]) }}
>
    @if(isset($header))
        <div class="bg-gray-50 dark:bg-gray-800 rounded-t-lg p-4 border-b border-gray-200 dark:border-gray-800">
            {{ $header }}
        </div>
    @endif
    <div class="p-4">
        {{ $slot }}
    </div>
    @if(isset($footer))
        <div class="bg-gray-50 dark:bg-gray-800 rounded-b-lg p-2 border-t border-gray-200 dark:border-gray-800">
            {{ $footer }}
        </div>
    @endif
</div>
