<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use LaraZeus\DynamicDashboard\Concerns\InteractWithWidgets;
use LaraZeus\DynamicDashboard\Contracts\Widget as ZeusWidget;

class PackagesOverview extends Widget implements ZeusWidget
{
    use InteractWithWidgets;

    protected static string $view = 'filament.widgets.packages-overview';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';
}
