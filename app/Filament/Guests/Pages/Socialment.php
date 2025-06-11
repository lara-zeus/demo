<?php

namespace App\Filament\Guests\Pages;

use BackedEnum;
use Filament\Pages\Page;
use UnitEnum;

class Socialment extends Page
{
    protected string $view = 'filament.guests.pages.socialment';

    protected static string | BackedEnum | null $navigationIcon = 'tabler-lock';

    protected static ?int $navigationSort = 4;

    protected static string | UnitEnum | null $navigationGroup = 'Plugins';
}
