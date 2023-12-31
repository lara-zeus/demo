<?php

namespace App\Filament\Tables\Columns;

use App\Filament\Concerns\HasPopover;
use Filament\Support\Concerns;
use Filament\Tables\Columns\Column;

class Popover extends Column
{
    use HasPopover;
    use Concerns\HasIcon;

    protected string $view = 'filament.tables.columns.popover';

    protected function setUp(): void
    {
        parent::setUp();

        $this->disabledClick();
    }
}
