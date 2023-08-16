<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class PackagesOverview extends Widget
{
    protected static string $view = 'filament.widgets.packages-overview';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';
}
