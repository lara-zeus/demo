<?php

namespace App\Filament\Tables\Columns;

use Filament\Support\Concerns;
use Filament\Tables\Columns\Column;

class Popover extends Column
{
    use Concerns\HasIcon;

    protected string $view = 'filament.tables.columns.popover';

    protected mixed $content = null;
    protected mixed $trigger = 'click';
    protected mixed $placement = 'top';
    protected array $offset = [0.10];
    protected string $maxWidth = '300';

    protected function setUp(): void
    {
        parent::setUp();

        $this->disabledClick();
    }

    public function content(mixed $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): mixed
    {
        return $this->evaluate($this->content);
    }

    public function trigger(mixed $trigger): static
    {
        $this->trigger = $trigger;

        return $this;
    }

    public function getTrigger(): mixed
    {
        return $this->evaluate($this->trigger);
    }

    public function placement(mixed $placement): static
    {
        $this->placement = $placement;

        return $this;
    }

    public function getPlacement(): mixed
    {
        return $this->evaluate($this->placement);
    }

    public function offset(array $offset): static
    {
        $this->offset = $offset;

        return $this;
    }

    public function getOffset(): array
    {
        return $this->offset;
    }

    public function maxWidth(string $maxWidth): static
    {
        $this->maxWidth = $maxWidth;

        return $this;
    }

    public function getMaxWidth(): string
    {
        return $this->maxWidth;
    }
}
