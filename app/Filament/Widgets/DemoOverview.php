<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use LaraZeus\DynamicDashboard\Concerns\InteractWithWidgets;
use LaraZeus\DynamicDashboard\Contracts\Widget as ZeusWidget;

class DemoOverview extends Widget implements ZeusWidget
{
    use InteractWithWidgets;

    protected static string $view = 'filament.widgets.demo-overview';

    protected static ?int $sort = 1;
}
