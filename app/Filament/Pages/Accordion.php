<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
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

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->state([
                'name'=>'Lara Zeus',
                'email'=>'info@larazeus.com',
                'personal-email'=>'info@larazeus.com',
                'personal-phone'=>'9999999999',
                'work-email'=>'info@larazeus.com',
                'work-phone'=>'9999999999',
            ])
            ->schema([
                \Filament\Infolists\Components\Section::make()
                ->schema([
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
                                ->icon('iconpark-commentone')
                                ->schema([
                                    TextEntry::make('name'),
                                    TextEntry::make('email'),
                                ]),
                            \LaraZeus\Accordion\Infolists\Accordion::make('user-data')
                                ->label('User Personal Contact')
                                ->icon('iconpark-comments')
                                ->columns()
                                ->schema([
                                    TextEntry::make('personal-email'),
                                    TextEntry::make('personal-phone'),
                                ]),
                            \LaraZeus\Accordion\Infolists\Accordion::make('work-data')
                                ->columns()
                                ->label('User Work Contact')
                                ->icon('iconpark-communication')
                                ->schema([
                                    TextEntry::make('work-email'),
                                    TextEntry::make('work-phone'),
                                ]),
                        ]),
                ])
            ]);
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
                                    ->badge('New Badge')
                                    ->badgeColor('info')
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
