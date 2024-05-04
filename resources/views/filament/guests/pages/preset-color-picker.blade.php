<x-filament-panels::page>

    <x-guests.package-card
        name="preset color picker"
        vendor="awcodes"
        github="matinee"
        filament="https://filamentphp.com/plugins/awcodes-preset-color-picker"
        image="https://github-production-user-asset-6210df.s3.amazonaws.com/3596800/316143008-e0c162db-6e21-4929-bbb5-f82f1a2e8f20.png?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAVCODYLSA53PQK4ZA%2F20240504%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20240504T211851Z&X-Amz-Expires=300&X-Amz-Signature=9881c6f963ea726b29a02d90407e3b0b9567bc98e536162aaf73f8cfbb37c32b&X-Amz-SignedHeaders=host&actor_id=1952412&key_id=0&repo_id=776144360"
    >
        <x-slot name="description">
            A color picker field for Filament Forms that uses preset color palettes.
        </x-slot>
    </x-guests.package-card>

    {{ $this->form }}
</x-filament-panels::page>
