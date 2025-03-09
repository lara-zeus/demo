<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
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
                    ]),
            ]);
    }

    public function getTitle(): string
    {
        return 'List Group';
    }

    protected function getHeaderActions(): array
    {
        return [
            DemoHeaderAction::make(),
        ];
    }
}
