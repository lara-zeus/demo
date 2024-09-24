<?php

namespace App\Filament\Guests\Pages;

use Awcodes\PresetColorPicker\PresetColorPicker;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Support\Facades\FilamentColor;

class ColorPicker extends Page
{
    protected static string $view = 'filament.guests.pages.preset-color-picker';

    protected static ?string $navigationIcon = 'tabler-photo';

    protected static ?string $navigationGroup = 'Plugins';

    protected static ?int $navigationSort = 3;

    protected ?string $heading = 'Preset Color Picker';

    protected static ?string $navigationLabel = 'Preset Color Picker';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
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
