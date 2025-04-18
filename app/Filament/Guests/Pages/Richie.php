<?php

namespace App\Filament\Guests\Pages;

use Awcodes\Richie\RichieEditor;
use Filament\Forms\Form;
use Filament\Pages\Page;

class Richie extends Page
{
    protected static string | \BackedEnum | null $navigationIcon = 'tabler-cash-edit';

    protected static string | \UnitEnum | null $navigationGroup = 'Plugins';

    protected ?string $heading = 'Richie is just another rich text editor for Filament PHP.';

    public ?array $data = [];

    protected string $view = 'filament.guests.pages.richie';

    public function mount(): void
    {
        $this->form->fill([]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                RichieEditor::make('content'),
            ]);
    }
}
