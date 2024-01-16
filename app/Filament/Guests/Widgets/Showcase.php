<?php

namespace App\Filament\Guests\Widgets;

use Filament\Widgets\Widget;

class Showcase extends Widget
{
    protected int | string | array $columnSpan = 'full';

    protected static string $view = 'filament.guests.widgets.showcase';
}
