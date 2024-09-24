<?php

namespace App\Filament\Guests\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;

class Matinee extends Page
{
    protected static string $view = 'filament.guests.pages.matinee';

    protected static ?string $navigationIcon = 'tabler-photo';

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
                \Awcodes\Matinee\Matinee::make('video')
                    ->showPreview(),
            ]);
    }
}
