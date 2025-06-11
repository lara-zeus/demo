<?php

namespace App\Filament\Guests\Pages;

use Awcodes\PresetColorPicker\PresetColorPicker;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use Filament\Support\Facades\FilamentColor;
use UnitEnum;

class ColorPicker extends Page
{
    protected string $view = 'filament.guests.pages.preset-color-picker';

    protected static string | BackedEnum | null $navigationIcon = 'tabler-photo';

    protected static string | UnitEnum | null $navigationGroup = 'Plugins';

    protected static ?int $navigationSort = 3;

    protected ?string $heading = 'Preset Color Picker';

    protected static ?string $navigationLabel = 'Preset Color Picker';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                PresetColorPicker::make('color')
                    ->default('Blue')
                    ->colors(
                        collect(FilamentColor::getColors())
                            ->forget(['primary', 'secondary', 'warning', 'info', 'danger', 'success', 'slate', 'zinc', 'neutral', 'stone'])
                            ->toArray()
                    ),
            ]);
    }
}
