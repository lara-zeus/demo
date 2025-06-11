<?php

namespace App\Filament\Guests\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use UnitEnum;

class Shout extends Page
{
    protected string $view = 'filament.guests.pages.shout';

    protected static string | BackedEnum | null $navigationIcon = 'tabler-message-chatbot';

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
