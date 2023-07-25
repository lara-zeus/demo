<?php

namespace App\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use GrahamCampbell\GitHub\Facades\GitHub;
use jeremykenedy\LaravelPackagist\App\Services\PackagistApiServices;

class GitStarsChart extends LineChartWidget
{
    protected static ?string $heading = 'Github Repositories Stats';

    protected int|string|array $columnSpan = 'full';

    protected static ?string $maxHeight = '200px';

    protected static ?int $sort = 10;

    protected function getData(): array
    {

        $repos = config('app.repos');
        $stars = $downloads = [];

        foreach ($repos as $repo) {
            $getStars = GitHub::repo()->show('lara-zeus', $repo);
            $stars[$repo] = $getStars['stargazers_count'];
            $downloads[$repo] = PackagistApiServices::getPackageTotalDownloads('lara-zeus/'.$repo);
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
