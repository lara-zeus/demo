<?php

namespace App\Tables\Columns;

use Filament\Tables\Columns\Column;

class RightClick extends Column
{
    protected string $view = 'tables.columns.right-click';

    protected mixed $actions = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->disabledClick();
    }

    public function actions(mixed $actions): static
    {
        $this->actions = $actions;

        return $this;
    }

    public function getActions(): mixed
    {
        return $this->evaluate($this->actions);
    }
}
