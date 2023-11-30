<?php

namespace App\Filament\Resources\LinksResource\Widgets;

use Filament\Widgets\ChartWidget;

class LinksStatsWidgets extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
