@php
    $isAside = $isAside();
@endphp

<x-filament::section
    :aside="$isAside"
    :collapsed="$isCollapsed()"
    :collapsible="$isCollapsible() && (! $isAside)"
    :compact="$isCompact()"
    :content-before="$isFormBefore()"
    :description="$getDescription()"
    :heading="$getHeading()"
    :icon="$getIcon()"
    :icon-color="$getIconColor()"
    :icon-size="$getIconSize()"
    :attributes="
        \Filament\Support\prepare_inherited_attributes($attributes)
            ->merge([
                'id' => $getId(),
            ], escape: false)
            ->merge($getExtraAttributes(), escape: false)
            ->merge($getExtraAlpineAttributes(), escape: false)
    "
>
    {{ $getChildComponentContainer() }}
</x-filament::section>
