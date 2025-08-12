<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use LaraZeus\DynamicDashboard\Concerns\InteractWithWidgets;
use LaraZeus\DynamicDashboard\Contracts\Widget as ZeusWidget;

class PackagesOverview extends Widget implements ZeusWidget
{
    use InteractWithWidgets;

    protected string $view = 'filament.widgets.packages-overview';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 'full';

    public static function canView(): bool
    {
        return false;
    }
}
