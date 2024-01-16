<?php

namespace App\Filament\Guests\Pages;

use Filament\Pages\Page;

class Socialment extends Page
{
    protected static string $view = 'filament.guests.pages.socialment';

    protected static ?string $navigationIcon = 'gameicon-lock';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Plugins';
}
