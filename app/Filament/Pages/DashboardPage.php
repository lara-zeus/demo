<?php

namespace App\Filament\Pages;

use LaraZeus\DynamicDashboard\Filament\Pages\DynamicDashboardPage;

class DashboardPage extends DynamicDashboardPage
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'My Dashboard';

    protected static ?string $title = 'My Dashboard';
}
