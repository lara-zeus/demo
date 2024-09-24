<?php

namespace App\Filament\Guests\Pages;

use Filament\Forms\Form;
use Filament\Pages\Page;

class Shout extends Page
{
    protected static string $view = 'filament.guests.pages.shout';

    protected static ?string $navigationIcon = 'tabler-message-chatbot';

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
                \Awcodes\Shout\Components\Shout::make('so-important')
                    ->type('info')
                    ->content('This is an info test'),
                \Awcodes\Shout\Components\Shout::make('so-important')
                    ->type('success')
                    ->content('This is a success test'),
                \Awcodes\Shout\Components\Shout::make('so-important')
                    ->type('warning')
                    ->content('This is a warning test'),
                \Awcodes\Shout\Components\Shout::make('so-important')
                    ->type('danger')
                    ->content('This is a danger test'),
            ]);
    }
}
