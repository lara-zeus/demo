<?php

namespace App\Filament\Pages;

use App\Filament\Pages\Actions\DemoHeaderAction;
use App\Filament\Pages\Widgets\GitDownChart;
use App\Filament\Pages\Widgets\GitStarsChart;
use BackedEnum;
use Filament\Pages\Page;

class Statistics extends Page
{
    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'filament.pages.statistics';

    protected function getFooterWidgets(): array
    {
        return [
            GitStarsChart::class,
            GitDownChart::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            DemoHeaderAction::make(),
        ];
    }
}
