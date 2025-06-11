<?php

namespace App\Filament\Guests\Pages;

use Awcodes\TableRepeater\Header;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use UnitEnum;

class TableRepeater extends Page
{
    protected string $view = 'filament.guests.pages.table-repeater';

    protected static string | BackedEnum | null $navigationIcon = 'tabler-repeat';

    protected static string | UnitEnum | null $navigationGroup = 'Plugins';

    protected static ?int $navigationSort = 3;

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
                \Awcodes\TableRepeater\Components\TableRepeater::make('users')
                    ->headers([
                        Header::make('first_name')->width('150px'),
                        Header::make('last_name')->width('150px'),
                    ])
                    ->schema([
                        TextInput::make('first_name'),
                        TextInput::make('last_name'),
                    ])
                    ->columnSpan('full'),
            ]);
    }
}
