<?php

namespace App\Filament\Pages\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use jeremykenedy\LaravelPackagist\App\Services\PackagistApiServices;
use LaraZeus\DynamicDashboard\Concerns\InteractWithWidgets;
use LaraZeus\DynamicDashboard\Contracts\Widget as ZeusWidget;

class GitDownChart extends ChartWidget implements ZeusWidget
{
    use InteractWithWidgets;

    protected static ?string $heading = 'Github Repositories Downloads';

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '200px';

    protected static ?int $sort = 99;

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $repos = config('app.repos');
        $downloads = [];

        foreach ($repos as $repo) {
            $downloads[$repo] = cache()->remember('git-downloads-' . $repo, Carbon::parse('1 day'), function () use ($repo) {
                return PackagistApiServices::getPackageTotalDownloads('lara-zeus/' . $repo);
            });
        }

        return [
            'datasets' => [
                [
                    'borderColor' => 'blue',
                    'label' => 'Downloads',
                    'data' => array_values($downloads),
                ],
            ],
            'labels' => $repos,
        ];
    }
}
