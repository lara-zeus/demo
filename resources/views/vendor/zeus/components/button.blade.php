<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'py-2 px-4 rounded-md shadow text-sm leading-5 font-medium focus:outline-none transition duration-300 ease-in-out' .
        ($attributes->get('disabled') ? ' opacity-75 cursor-not-allowed' : '').
        ($attributes->get('color')
            ? ' bg-'.$attributes->get('color').'-600 text-'.$attributes->get('color').'-50 hover:text-'.$attributes->get('color').'-200 hover:bg-'.$attributes->get('color').'-800'
            : ' bg-primary-600 text-primary-50 hover:text-primary-200 hover:bg-primary-800')
        ,
    ]) }}
>
    {{ $slot }}
</button>
