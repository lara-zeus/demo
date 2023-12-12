<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use LaraZeus\DynamicDashboard\Concerns\InteractWithWidgets;
use LaraZeus\DynamicDashboard\Contracts\Widget as ZeusWidget;

class SupportWidget extends Widget implements ZeusWidget
{
    use InteractWithWidgets;

    protected static string $view = 'filament.widgets.support-widget';

    protected static ?int $sort = 2;
}
