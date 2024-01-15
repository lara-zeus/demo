<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Page;
use LaraZeus\Accordion\Forms\Accordions;

class Accordion extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static ?string $navigationIcon = 'vaadin-accordion-menu';

    protected static string $view = 'filament.pages.accordion';

    protected static ?int $navigationSort = 4;

    public array $data;

    public static function getNavigationLabel(): string
    {
        return 'Accordion';
    }

    public function getTitle(): string
    {
        return 'Accordion';
    }

    public function form(Form $form): Form
    {
        return $form
            ->statePath('data')
            ->schema([
                Section::make()
                    ->schema([
                        Accordions::make('Options')
                            ->activeAccordion(2)
                            ->isolated()

                            ->columnSpanFull()
                            ->accordions([
                                \LaraZeus\Accordion\Forms\Accordion::make('main-data')
                                    ->columns()
                                    ->label('User Details')
                                    ->icon('iconpark-commentone')
                                    ->schema([
                                        TextInput::make('name')->required(),
                                        TextInput::make('email')->required(),
                                    ]),

                                \LaraZeus\Accordion\Forms\Accordion::make('user-data')
                                    ->label('User Personal Contact')
                                    ->icon('iconpark-comments')
                                    ->columns()
                                    ->schema([
                                        TextInput::make('personal-email')->required(),
                                        TextInput::make('personal-phone')->required(),
                                    ]),

                                \LaraZeus\Accordion\Forms\Accordion::make('work-data')
                                    ->columns()
                                    ->label('User Work Contact')
                                    ->icon('iconpark-communication')
                                    ->schema([
                                        TextInput::make('work-email')->required(),
                                        TextInput::make('work-phone')->required(),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
