<?php

namespace App\Filament\Guests\Pages;

use BackedEnum;
use Filament\Pages\Page;
use Filament\Schemas\Schema;
use UnitEnum;

class Matinee extends Page
{
    protected string $view = 'filament.guests.pages.matinee';

    protected static string | BackedEnum | null $navigationIcon = 'tabler-photo';

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
                \Awcodes\Matinee\Matinee::make('video')
                    ->showPreview(),
            ]);
    }
}
