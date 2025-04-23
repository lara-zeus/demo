<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class Feedback extends Widget
{
    protected string $view = 'filament.widgets.feedback';

    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 'full';
}
