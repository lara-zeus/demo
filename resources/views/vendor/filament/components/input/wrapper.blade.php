@props([
    'alpineDisabled' => null,
    'alpineValid' => null,
    'disabled' => false,
    'inlinePrefix' => false,
    'inlineSuffix' => false,
    'prefix' => null,
    'prefixActions' => [],
    'prefixIcon' => null,
    'prefixIconAlias' => null,
    'suffix' => null,
    'suffixActions' => [],
    'suffixIcon' => null,
    'suffixIconAlias' => null,
    'valid' => true,
])

@php
    $hasPrefix = count($prefixActions) || $prefixIcon || filled($prefix);
    $hasSuffix = count($suffixActions) || $suffixIcon || filled($suffix);

    $hasAlpineDisabledClasses = filled($alpineDisabled);
    $hasAlpineValidClasses = filled($alpineValid);
    $hasAlpineClasses = $hasAlpineDisabledClasses || $hasAlpineValidClasses;

    $enabledWrapperClasses = 'bg-white focus-within:ring-2 dark:bg-white/5';
    $disabledWrapperClasses = 'bg-gray-50 dark:bg-transparent';
    $validWrapperClasses = 'ring-gray-950/10';
    $invalidWrapperClasses = 'ring-danger-600 dark:ring-danger-500';
    $enabledValidWrapperClasses = 'focus-within:ring-custom-600 dark:ring-white/20 dark:focus-within:ring-custom-500';
    $enabledInvalidWrapperClasses = 'focus-within:ring-danger-600 dark:focus-within:ring-danger-500';
    $disabledValidWrapperClasses = 'dark:ring-white/10';

    $actionsClasses = '-mx-1.5 flex items-center';
    $iconClasses = 'fi-input-wrp-icon h-5 w-5 text-gray-400 dark:text-gray-500';
    $labelClasses = 'fi-input-wrp-label whitespace-nowrap text-sm text-gray-500 dark:text-gray-400';

    $prefixActions = array_filter(
        $prefixActions,
        fn (\Filament\Forms\Components\Actions\Action $prefixAction): bool => $prefixAction->isVisible(),
    );

    $suffixActions = array_filter(
        $suffixActions,
        fn (\Filament\Forms\Components\Actions\Action $suffixAction): bool => $suffixAction->isVisible(),
    );

    $wireTarget = $attributes->whereStartsWith(['wire:target'])->first();

    $hasLoadingIndicator = filled($wireTarget);

    if ($hasLoadingIndicator) {
        $loadingIndicatorTarget = html_entity_decode($wireTarget, ENT_QUOTES);
    }
@endphp

<div
    @if ($hasAlpineClasses)
        x-bind:class="{
            {{ $hasAlpineDisabledClasses ? "'{$enabledWrapperClasses}': ! ({$alpineDisabled})," : null }}
            {{ $hasAlpineDisabledClasses ? "'{$disabledWrapperClasses}': {$alpineDisabled}," : null }}
            {{ $hasAlpineValidClasses ? "'{$validWrapperClasses}': {$alpineValid}," : null }}
            {{ $hasAlpineValidClasses ? "'{$invalidWrapperClasses}': ! ({$alpineValid})," : null }}
            {{ ($hasAlpineDisabledClasses && $hasAlpineValidClasses) ? "'{$enabledValidWrapperClasses}': ! ({$alpineDisabled}) && {$alpineValid}," : null }}
            {{ ($hasAlpineDisabledClasses && $hasAlpineValidClasses) ? "'{$enabledInvalidWrapperClasses}': ! ({$alpineDisabled}) && ! ({$alpineValid})," : null }}
            {{ ($hasAlpineDisabledClasses && $hasAlpineValidClasses) ? "'{$disabledValidWrapperClasses}': {$alpineDisabled} && ! ({$alpineValid})," : null }}
        }"
    @endif
    {{
        $attributes
            ->except(['wire:target'])
            ->class([
                'fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75',
                $enabledWrapperClasses => (! $hasAlpineClasses) && (! $disabled),
                $disabledWrapperClasses => (! $hasAlpineClasses) && $disabled,
                $validWrapperClasses => (! $hasAlpineClasses) && $valid,
                $invalidWrapperClasses => (! $hasAlpineClasses) && (! $valid),
                $enabledValidWrapperClasses => (! $hasAlpineClasses) && (! $disabled) && $valid,
                $enabledInvalidWrapperClasses => (! $hasAlpineClasses) && (! $disabled) && (! $valid),
                $disabledValidWrapperClasses => (! $hasAlpineClasses) && $disabled && $valid,
            ])
    }}
>
    @if ($hasPrefix || $hasLoadingIndicator)
        <div
            @if (! $hasPrefix)
                wire:loading.delay.flex
                wire:target="{{ $loadingIndicatorTarget }}"
                wire:key="{{ \Illuminate\Support\Str::random() }}" {{-- Makes sure the loading indicator gets hidden again. --}}
            @endif
            @class([
                'items-center gap-x-3 ps-3',
                'flex' => $hasPrefix,
                'hidden' => ! $hasPrefix,
                'pe-1' => $inlinePrefix && filled($prefix),
                'pe-2' => $inlinePrefix && blank($prefix),
                'border-e border-gray-200 pe-3 ps-3 dark:border-white/10' => ! $inlinePrefix,
            ])
        >
            @if (count($prefixActions))
                <div class="{{ $actionsClasses }}">
                    @foreach ($prefixActions as $prefixAction)
                        {{ $prefixAction }}
                    @endforeach
                </div>
            @endif

            @if ($prefixIcon)
                <x-filament::icon
                    :alias="$prefixIconAlias"
                    :icon="$prefixIcon"
                    :wire:loading.remove.delay="$hasLoadingIndicator"
                    :wire:target="$hasLoadingIndicator ? $loadingIndicatorTarget : null"
                    :class="$iconClasses"
                />
            @endif

            @if ($hasLoadingIndicator)
                <x-filament::loading-indicator
                    :attributes="
                        \Filament\Support\prepare_inherited_attributes(
                            new \Illuminate\View\ComponentAttributeBag([
                                'wire:loading.delay' => $hasPrefix,
                                'wire:target' => $hasPrefix ? $loadingIndicatorTarget : null,
                            ])
                        )
                    "
                    :class="$iconClasses"
                />
            @endif

            @if (filled($prefix))
                <span class="{{ $labelClasses }}">
                    {{ $prefix }}
                </span>
            @endif
        </div>
    @endif

    <div
        @if ($hasLoadingIndicator && (! $hasPrefix))
            @if ($inlinePrefix)
                wire:loading.delay.class.remove="ps-3"
            @endif

            wire:target="{{ $loadingIndicatorTarget }}"
        @endif
        @class([
            'min-w-0 flex-1',
            'ps-3' => $hasLoadingIndicator && (! $hasPrefix) && $inlinePrefix,
        ])
    >
        {{ $slot }}
    </div>

    @if ($hasSuffix)
        <div
            @class([
                'flex items-center gap-x-3 pe-3',
                'ps-1' => $inlineSuffix && filled($suffix),
                'ps-2' => $inlineSuffix && blank($suffix),
                'border-s border-gray-200 ps-3 dark:border-white/10' => ! $inlineSuffix,
            ])
        >
            @if (filled($suffix))
                <span class="{{ $labelClasses }}">
                    {{ $suffix }}
                </span>
            @endif

            @if ($suffixIcon)
                <x-filament::icon
                    :alias="$suffixIconAlias"
                    :icon="$suffixIcon"
                    :class="$iconClasses"
                />
            @endif

            @if (count($suffixActions))
                <div class="{{ $actionsClasses }}">
                    @foreach ($suffixActions as $suffixAction)
                        {{ $suffixAction }}
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div>
