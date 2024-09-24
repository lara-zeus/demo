<?php

namespace App\Filament\Guests\Pages;

use Awcodes\TableRepeater\Header;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;

class TableRepeater extends Page
{
    protected static string $view = 'filament.guests.pages.table-repeater';

    protected static ?string $navigationIcon = 'tabler-repeat';

    protected static ?string $navigationGroup = 'Plugins';

    protected static ?int $navigationSort = 3;

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
