<?php

namespace App\Filament\Guests\Pages;

use App\Mason\BrickCollection;
use App\Models\Mason as MasonModel;
use Awcodes\Richie\RichieEditor;
use Filament\Forms\Form;
use Filament\Pages\Page;

class Richie extends Page
{
    protected static ?string $navigationIcon = 'tabler-cash-edit';

    protected static ?string $navigationGroup = 'Plugins';

    protected ?string $heading = 'Richie is just another rich text editor for Filament PHP.';

    public ?array $data = [];

    protected static string $view = 'filament.guests.pages.richie';

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
