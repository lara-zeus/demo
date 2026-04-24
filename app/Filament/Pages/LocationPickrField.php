<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use LaraZeus\FilamentLocationPickrField\Forms\Components\LocationPickr as LocationPickrFieldComponent;

class LocationPickrField extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static string | \BackedEnum | null $navigationIcon = 'tabler-map-pin';

    protected string $view = 'filament.pages.location-pickr-field';

    protected static ?int $navigationSort = 10;

    protected static ?string $navigationLabel = 'Location Pickr';

    protected static ?string $title = 'Filament Location Pickr Field';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'location' => [
                'lat' => 40.712776,
                'lng' => -74.005974,
            ],
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([
                Section::make('Form field')
                    ->schema([
                        LocationPickrFieldComponent::make('location')
                            ->label('Pick location')
                            ->defaultLocation([40.712776, -74.005974])
                            ->defaultZoom(10)
                            ->draggable()
                            ->clickable()
                            ->height('350px')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            DemoHeaderAction::make(),
        ];
    }
}
