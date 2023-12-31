<?php

namespace App\Filament\Infolists\Components;

use App\Filament\Concerns\HasPopover;
use Filament\Infolists\Components\Concerns\HasIcon;
use Filament\Infolists\Components\Entry;

class Popover extends Entry
{
    use HasPopover;
    use HasIcon;

    protected string $view = 'filament.tables.columns.popover';
}
