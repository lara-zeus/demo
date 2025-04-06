<?php

namespace App\Filament\Pages\Widgets;

use Filament\Widgets\ChartWidget;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Support\Carbon;
use LaraZeus\DynamicDashboard\Concerns\InteractWithWidgets;
use LaraZeus\DynamicDashboard\Contracts\Widget as ZeusWidget;

class GitStarsChart extends ChartWidget implements ZeusWidget
{
    use InteractWithWidgets;

    protected ?string $heading = 'Github Repositories Stars';

    protected int | string | array $columnSpan = 'full';

    protected ?string $maxHeight = '200px';

    protected static ?int $sort = 99;

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $repos = config('app.repos');
        $stars = [];

        foreach ($repos as $repo) {
            $stars[$repo] = cache()->remember('git-stars-' . $repo, Carbon::parse('1 day'), function () use ($repo) {
                return GitHub::repo()->show('lara-zeus', $repo);
            })['stargazers_count'];
        }

        return [
            'datasets' => [
                [
                    'borderColor' => 'red',
                    'label' => 'Stars',
                    'data' => array_values($stars),
                ],
            ],
            'labels' => $repos,
        ];
    }
}
