@props([
    'actions' => [],
    'badge' => null,
    'badgeColor' => null,
    'button' => false,
    'color' => null,
    'dropdownMaxHeight' => null,
    'dropdownPlacement' => null,
    'dropdownWidth' => null,
    'dynamicComponent' => null,
    'group' => null,
    'icon' => null,
    'iconPosition' => null,
    'iconSize' => null,
    'iconButton' => false,
    'label' => null,
    'link' => false,
    'size' => null,
    'tooltip' => null,
    'view' => null,
])

@if (! ($dynamicComponent && $group))
    @php
        $group = \Filament\Actions\ActionGroup::make($actions)
            ->badgeColor($badgeColor)
            ->color($color)
            ->dropdownMaxHeight($dropdownMaxHeight)
            ->dropdownPlacement($dropdownPlacement)
            ->dropdownWidth($dropdownWidth)
            ->icon($icon)
            ->iconPosition($iconPosition)
            ->iconSize($iconSize)
            ->label($label)
            ->size($size)
            ->tooltip($tooltip)
            ->view($view);

        $badge === true
            ? $group->badge()
            : $group->badge($badge);

        if ($button) {
            $group->button();
        }

        if ($iconButton) {
            $group->iconButton();
        }

        if ($link) {
            $group->link();
        }
    @endphp

    {{ $group }}
@elseif (! $group->hasDropdown())
    @foreach ($group->getActions() as $action)
        @if ($action->isVisible())
            {{ $action }}
        @endif
    @endforeach
@else
    @php
        $actionLists = [];
        $singleActions = [];

        foreach ($group->getActions() as $action) {
            if ($action->isHidden()) {
                continue;
            }

            if ($action instanceof \Filament\Actions\ActionGroup && (! $action->hasDropdown())) {
                if (count($singleActions)) {
                    $actionLists[] = $singleActions;
                    $singleActions = [];
                }

                $actionLists[] = array_filter(
                    $action->getActions(),
                    fn ($action): bool => $action->isVisible(),
                );
            } else {
                $singleActions[] = $action;
            }
        }

        if (count($singleActions)) {
            $actionLists[] = $singleActions;
        }
    @endphp

    <x-filament::dropdown
        :max-height="$group->getDropdownMaxHeight()"
        :placement="$group->getDropdownPlacement() ?? 'bottom-start'"
        :width="$group->getDropdownWidth()"
        teleport
    >
        <x-slot name="trigger">
            <x-dynamic-component
                :color="$group->getColor()"
                :component="$dynamicComponent"
                :icon="$group->getIcon()"
                :icon-size="$group->getIconSize()"
                :label-sr-only="$group->isLabelHidden()"
                :tooltip="$group->getTooltip()"
                :attributes="\Filament\Support\prepare_inherited_attributes($attributes)->merge($group->getExtraAttributes(), escape: false)"
            >
                {{ $slot }}
            </x-dynamic-component>
        </x-slot>

        @foreach ($actionLists as $actions)
            <x-filament::dropdown.list>
                @foreach ($actions as $action)
                    {{ $action }}
                @endforeach
            </x-filament::dropdown.list>
        @endforeach
    </x-filament::dropdown>
@endif
