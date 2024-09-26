<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class BlackFriday extends Widget
{
    protected static string $view = 'filament.widgets.black-friday';

    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';
}
