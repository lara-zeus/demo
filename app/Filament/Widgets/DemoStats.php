<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class DemoStats extends ChartWidget
{
    protected static ?string $heading = 'User Activities';

    public function id()
    {
        return rand(1,99);
    }

    public static function canView(): bool
    {
        return false;
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                array(
                    'label' => 'users activities',
                    'data' => array(rand(1,99), rand(1,99), rand(1,99), rand(1,99), rand(1,99), rand(1,99), rand(1,99), rand(1,99), rand(1,99), rand(1,99), rand(1,99), rand(1,99)),
                ),
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
