<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use LaraZeus\Accordion\Forms\Accordions;
use LaraZeus\ListGroup\Infolists\ListEntry;
use LaraZeus\ListGroup\Item\ListItem;

class ListGroup extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static ?string $navigationIcon = 'tabler-list-details';

    protected static string $view = 'filament.pages.list-group';

    protected static ?int $navigationSort = 8;

    public ?array $data;

    public static function getNavigationLabel(): string
    {
        return 'List Group';
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Section::make()
                    ->schema([
                        ListEntry::make('items')
                            ->columnSpanFull()
                            ->grouped()
                            ->heading('Support Channels:')
                            ->state([
                                ListItem::make()
                                    ->color('warning')
                                    ->id(1)
                                    ->url('#')
                                    ->icon('tabler-checks')
                                    ->iconColor('danger')
                                    ->label('Documentations'),

                                ListItem::make()
                                    ->color('success')
                                    ->id(2)
                                    ->url('#')
                                    ->icon('tabler-check')
                                    ->iconColor('info')
                                    ->label('Support'),
                            ]),

                        ListEntry::make('items')
                            ->columnSpanFull()
                            ->list()
                            ->heading('Support Channels:')
                            ->state([
                                ListItem::make()
                                    ->color('warning')
                                    ->id(1)
                                    ->url('#')
                                    ->label('Documentations'),
                                ListItem::make()
                                    ->color('success')
                                    ->id(2)
                                    ->url('#')
                                    ->label('Support'),
                            ]),
                        /*->state([
                                [
                                    'id' => 1,
                                    'label' => 'label1',
                                    //'icon' => 'tabler-forklift',
                                    'icon' => null,
                                    'iconSize' => 'tabler-forklift',
                                    'color' => 'color1',
                                    'url' => 'url1',
                                    'badge' => 'badge1',
                                ],
                                [
                                    'id' => 2,
                                    'label' => 'label2',
                                    //'icon' => 'tabler-devices-off',
                                    'icon' => null,
                                    'iconSize' => 'tabler-devices-off',
                                    'color' => 'color2',
                                    'url' => 'url2',
                                    'badge' => 'badge2',
                                ],
                                [
                                    'id' => 3,
                                    'label' => 'label3',
                                    //'icon' => 'tabler-skateboarding',
                                    'icon' => null,
                                    'iconSize' => 'tabler-skateboarding',
                                    'color' => 'color3',
                                    'url' => 'url3',
                                    'badge' => 'badge3',
                                ],
                            ])*/
                    ]),
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
