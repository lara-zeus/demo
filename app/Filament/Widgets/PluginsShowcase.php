<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class PluginsShowcase extends Widget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.widgets.plugins-showcase';
}
