<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Pages\Page;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use LaraZeus\Accordion\Forms\Accordions;

class Accordion extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static string | BackedEnum | null $navigationIcon = 'tabler-table-filled';

    protected string $view = 'filament.pages.accordion';

    protected static ?int $navigationSort = 4;

    public ?array $data = [];

    protected static ?string $navigationLabel = 'Accordion';

    protected static ?string $title = 'Accordion';

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->state([
                'name' => 'Lara Zeus',
                'email' => 'info@larazeus.com',
                'personal-email' => 'info@larazeus.com',
                'personal-phone' => '9999999999',
                'work-email' => 'info@larazeus.com',
                'work-phone' => '9999999999',
            ])
            ->components([
                \LaraZeus\Accordion\Infolists\Accordions::make('Options')
                    ->activeAccordion(2)
                    ->isolated()
                    ->columnSpanFull()
                    ->accordions([
                        \LaraZeus\Accordion\Infolists\Accordion::make('main-data')
                            ->columns()
                            ->badge('New Badge')
                            ->badgeColor('info')
                            ->label('User Details')
                            ->icon('tabler-arrow-right-to-arc')
                            ->schema([
                                TextEntry::make('name'),
                                TextEntry::make('email'),
                            ]),
                        \LaraZeus\Accordion\Infolists\Accordion::make('user-data')
                            ->label('User Personal Contact')
                            ->icon('tabler-arrow-right-to-arc')
                            ->columns()
                            ->schema([
                                TextEntry::make('personal-email'),
                                TextEntry::make('personal-phone'),
                            ]),
                        \LaraZeus\Accordion\Infolists\Accordion::make('work-data')
                            ->columns()
                            ->label('User Work Contact')
                            ->icon('tabler-arrow-right-to-arc')
                            ->schema([
                                TextEntry::make('work-email'),
                                TextEntry::make('work-phone'),
                            ]),
                    ]),
            ]);
    }

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->statePath('data')
            ->components([

                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Tab 1')
                            ->schema([
                                TextInput::make('name_a')
                                    // ->default('first name')
                                    ->required(),
                            ]),
                        Tab::make('Tab 2')
                            ->schema([
                                TextInput::make('email_a')
                                    ->default('first email')
                                    ->required(),
                            ]),
                        Tab::make('Tab 3')
                            ->schema([
                                TextInput::make('car_type')
                                    ->default('car type')
                                    ->required(),
                            ]),
                    ]),

                /*Accordions::make('Options')
                    ->activeAccordion(2)
                    ->isolated()
                    ->columnSpanFull()
                    ->accordions([
                        \LaraZeus\Accordion\Forms\Accordion::make('main-data')
                            ->columns()
                            ->badge('New Badge')
                            ->badgeColor('info')
                            ->label('User Details')
                            ->icon('tabler-arrow-right-to-arc')
                            ->schema([
                                TextInput::make('name')->required(),
                                TextInput::make('email')->required(),
                            ]),

                        \LaraZeus\Accordion\Forms\Accordion::make('user-data')
                            ->label('User Personal Contact')
                            ->icon('tabler-arrow-right-to-arc')
                            ->columns()
                            ->schema([
                                TextInput::make('personal-email')->required(),
                                TextInput::make('personal-phone')->required(),
                            ]),

                        \LaraZeus\Accordion\Forms\Accordion::make('work-data')
                            ->columns()
                            ->label('User Work Contact')
                            ->icon('tabler-arrow-right-to-arc')
                            ->schema([
                                TextInput::make('work-email')->required(),
                                TextInput::make('work-phone')->required(),
                            ]),
                    ]),*/
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            DemoHeaderAction::make(),
        ];
    }

    public function create(): void
    {
        dd($this->form->getState());
    }
}
