<?php

namespace App\Filament\DemoWidgets;

use LaraZeus\InlineChart\InlineChartWidget;

class MiniChart extends InlineChartWidget
{
    protected static ?string $pollingInterval = null;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'created',
                    'data' => [
                        rand(1, 7),
                        rand(1, 7),
                        rand(1, 7),
                        rand(1, 7),
                        rand(1, 7),
                        rand(1, 7),
                        rand(1, 7),
                    ],

                    'backgroundColor' => '#45B39D',
                    'borderColor' => '#45B39D',
                    'cubicInterpolationMode' => 'monotone',
                ],
                [
                    'label' => 'updated',
                    'data' => [
                        rand(1, 7),
                        rand(1, 7),
                        rand(1, 7),
                        rand(1, 7),
                        rand(1, 7),
                        rand(1, 7),
                        rand(1, 7),
                    ],
                    'backgroundColor' => '#F1948A',
                    'borderColor' => '#F1948A',
                    'cubicInterpolationMode' => 'monotone',
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
