<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Widgets\GitStarsChart;
use Filament\Pages\Page;
use Schmeits\FilamentUmami\Concerns\HasFilter;
use Schmeits\FilamentUmami\Widgets\UmamiWidgetStatsGrouped;
use Schmeits\FilamentUmami\Widgets\UmamiWidgetTableReferrers;
use Schmeits\FilamentUmami\Widgets\UmamiWidgetTableUrls;

class Statistics extends Page
{
    use HasFilter;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.statistics';

    protected function getFooterWidgets(): array
    {
        return [
            UmamiWidgetStatsGrouped::class,
            UmamiWidgetTableReferrers::class,
            UmamiWidgetTableUrls::class,

            GitStarsChart::class
        ];
    }
}
