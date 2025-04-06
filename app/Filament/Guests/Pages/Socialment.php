<?php

namespace App\Filament\Guests\Pages;

use Filament\Pages\Page;

class Socialment extends Page
{
    protected string $view = 'filament.guests.pages.socialment';

    protected static string | \BackedEnum | null $navigationIcon = 'tabler-lock';

    protected static ?int $navigationSort = 4;

    protected static ?string $navigationGroup = 'Plugins';
}
