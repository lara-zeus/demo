<?php

namespace App\Filament\Pages\Widgets;

use Filament\Widgets\ChartWidget;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Carbon;
use jeremykenedy\LaravelPackagist\App\Services\PackagistApiServices;
use LaraZeus\DynamicDashboard\Concerns\InteractWithWidgets;
use LaraZeus\DynamicDashboard\Contracts\Widget as ZeusWidget;

class GitStarsChart extends ChartWidget implements ZeusWidget
{
    use InteractWithWidgets;

    protected static ?string $heading = 'Github Repositories Stats';

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
        $stars = $downloads = [];

        foreach ($repos as $repo) {
            $getStars = cache()->remember('git-stars-' . $repo, Carbon::parse('1 day'), function () use ($repo) {
                return GitHub::repo()->show('lara-zeus', $repo);
            });
            $stars[$repo] = $getStars['stargazers_count'];
            $downloads[$repo] = cache()->remember('git-downloads-' . $repo, Carbon::parse('1 day'), function () use ($repo) {
                return PackagistApiServices::getPackageTotalDownloads('lara-zeus/' . $repo);
            });
        }

        return [
            'datasets' => [
                [
                    'borderColor' => 'red',
                    'label' => 'Stars',
                    'data' => array_values($stars),
                ],
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
