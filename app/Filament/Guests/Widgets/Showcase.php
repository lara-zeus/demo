<?php

namespace App\Filament\Guests\Widgets;

use Filament\Widgets\Widget;

class Showcase extends Widget
{
    protected int | string | array $columnSpan = 'full';

    protected string $view = 'filament.guests.widgets.showcase';
}
