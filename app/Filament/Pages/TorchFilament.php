<?php

namespace App\Filament\Pages;

use App\Filament\Clusters\ComponentsDemo;
use App\Filament\Pages\Actions\DemoHeaderAction;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Infolist;
use Filament\Pages\Page;
use LaraZeus\TorchFilament\Infolists\TorchEntry;

class TorchFilament extends Page
{
    protected static ?string $cluster = ComponentsDemo::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected string $view = 'filament.pages.torch-filament';

    protected static ?int $navigationSort = 8;

    public array $data = [];

    public function infolist(\Filament\Schemas\Schema $schema): \Filament\Schemas\Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make()
                    ->schema([
                        TorchEntry::make('code')
                            ->columnSpanFull()
                            ->theme([
                                'light' => 'everforest-light',
                                'dark' => 'everforest-dark',
                            ])
                            // ->withGutter(false)
                            // ->withWrapper(true)
                            // ->grammar('php')
                            ->state(<<<'PHP'
                                echo "Hello, world!";
                                echo "Hello, world! I am focused"; // [tl! focus]
                                echo "Hello, world! Added"; // [tl! ++]
                                echo "Hello, world! Deleted"; // [tl! --]
                            PHP),
                    ]),
            ]);
    }

    public function getTitle(): string
    {
        return 'Torch Filament';
    }

    public static function getNavigationLabel(): string
    {
        return 'Torch Filament';
    }

    protected function getHeaderActions(): array
    {
        return [
            DemoHeaderAction::make(),
        ];
    }
}
