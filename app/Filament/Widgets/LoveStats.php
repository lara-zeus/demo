<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Route;
use LaraZeus\Mark\Models\MarkLike;

class LoveStats extends BaseWidget
{
    public static function canView(): bool
    {
        return Route::currentRouteName() !== 'filament.admin.pages.dashboard';
    }

    protected function getStats(): array
    {
        return [
            Stat::make('Total Likes', MarkLike::count()),
        ];
    }
}
